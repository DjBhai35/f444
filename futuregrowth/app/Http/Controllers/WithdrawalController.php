<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Withdrawal;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WithdrawalController extends Controller
{
    public function create()
    {
        $minWithdrawal = setting('min_withdrawal', 10);
        $maxWithdrawal = setting('max_withdrawal', 10000);
        $feePercent = setting('withdrawal_fee_percent', 5);
        $user = Auth::user();
        $wallet = $user->wallet;
        $totalAvailable = $wallet->roi_balance + $wallet->referral_balance + ($wallet->salary_balance ?? 0);

        return view('dashboard.withdrawals.create', compact('minWithdrawal', 'maxWithdrawal', 'feePercent', 'totalAvailable'));
    }

    public function store(Request $request)
    {
        $minWithdrawal = (float) setting('min_withdrawal', 10);
        $maxWithdrawal = (float) setting('max_withdrawal', 10000);
        $feePercent = (float) setting('withdrawal_fee_percent', 5);
        
        $request->validate([
            'amount' => 'required|numeric|min:' . $minWithdrawal . '|max:' . $maxWithdrawal,
            'wallet_address' => 'required|string|max:255',
            'balance_type' => 'required|in:roi_balance,referral_balance,salary_balance'
        ]);

        $userId = Auth::id();
        $amount = (float) $request->amount;
        $type = $request->balance_type;
        $walletAddress = $request->wallet_address;

        $fee = ($amount * $feePercent) / 100;
        $netAmount = $amount - $fee;

        $withdrawal = DB::transaction(function () use ($userId, $amount, $type, $fee, $netAmount, $walletAddress) {
            // Lock user record and wallet to prevent concurrent double-spending
            $lockedUser = User::where('id', $userId)->lockForUpdate()->first();
            $wallet = $lockedUser->wallet;

            if ((float) $wallet->$type < $amount) {
                return false;
            }

            // Deduct balance atomically
            $wallet->$type -= $amount;
            $wallet->save();

            $newWithdrawal = Withdrawal::create([
                'user_id' => $lockedUser->id,
                'amount' => $amount,
                'fee' => $fee,
                'net_amount' => $netAmount,
                'wallet_address' => $walletAddress,
                'wallet_type' => $type,
                'status' => 'pending'
            ]);

            Transaction::create([
                'user_id' => $lockedUser->id,
                'type' => 'withdrawal',
                'amount' => $amount,
                'wallet_type' => $type,
                'status' => 'pending',
                'description' => 'Withdrawal request submitted. Fee: $' . number_format($fee, 2) . ', Net: $' . number_format($netAmount, 2),
                'reference_id' => $newWithdrawal->id
            ]);

            return $newWithdrawal;
        });

        if (!$withdrawal) {
            return back()->withErrors(['amount' => 'Insufficient balance in selected wallet.']);
        }

        // Send email notifications to administrators fail-safe outside transaction
        $admins = User::where('is_admin', true)->get();
        foreach ($admins as $admin) {
            try {
                \Illuminate\Support\Facades\Mail::to($admin->email)->send(new \App\Mail\AdminWithdrawalNotificationMail($withdrawal));
            } catch (\Exception $e) {
                // Fail-safe to keep platform stable if mail server credentials are incorrect/offline
            }
        }

        return redirect()->route('dashboard.history')->with('success', 'Your withdrawal request has been received successfully. Withdrawals are processed within 3 business days after admin approval.');
    }
}
