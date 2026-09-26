<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Investment;
use App\Models\User;
use App\Models\Transaction;
use App\Services\ReferralService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvestmentController extends Controller
{
    protected $referralService;

    public function __construct(ReferralService $referralService)
    {
        $this->referralService = $referralService;
    }

    public function index()
    {
        $plans = Plan::where('status', 'active')->get();
        $wallet = Auth::user()->wallet;
        $totalBalance = $wallet->deposit_balance + $wallet->bonus_balance; // Allow investing from deposit or bonus
        
        return view('dashboard.investments.index', compact('plans', 'totalBalance'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
            'amount' => 'required|numeric|min:0.01'
        ]);

        $plan = Plan::findOrFail($request->plan_id);
        $amount = (float) $request->amount;

        if ($amount < (float) $plan->min_amount || $amount > (float) $plan->max_amount) {
            return back()->withErrors(['amount' => 'Amount must be between $' . $plan->min_amount . ' and $' . $plan->max_amount]);
        }

        $userId = Auth::id();

        $investment = DB::transaction(function () use ($userId, $plan, $amount) {
            // Concurrency safety: lock user record and wallet to prevent race-condition double-spending
            $lockedUser = User::where('id', $userId)->lockForUpdate()->first();
            $wallet = $lockedUser->wallet;

            $totalAvailable = (float) $wallet->deposit_balance + (float) $wallet->bonus_balance;
            if ($totalAvailable < $amount) {
                return false;
            }

            // Deduct from deposit balance first, then bonus
            $fromDeposit = 0.0;
            $fromBonus = 0.0;

            if ($wallet->deposit_balance >= $amount) {
                $wallet->deposit_balance -= $amount;
                $fromDeposit = $amount;
            } else {
                $fromDeposit = (float) $wallet->deposit_balance;
                $fromBonus = $amount - $fromDeposit;
                $wallet->deposit_balance = 0.0;
                $wallet->bonus_balance -= $fromBonus;
            }

            $wallet->save();

            // Calculate dynamic ROI percent for this user matching existing plan ROI range
            $roiPercent = rand((int)($plan->min_roi * 10), (int)($plan->max_roi * 10)) / 10;

            $newInvestment = Investment::create([
                'user_id' => $lockedUser->id,
                'plan_id' => $plan->id,
                'amount' => $amount,
                'daily_roi_percent' => $roiPercent,
                'status' => 'active'
            ]);

            // Financial Ledger Traceability: Record investment balance debit transactions
            if ($fromDeposit > 0) {
                Transaction::create([
                    'user_id' => $lockedUser->id,
                    'type' => 'investment',
                    'amount' => $fromDeposit,
                    'wallet_type' => 'deposit_balance',
                    'status' => 'completed',
                    'description' => "Investment in {$plan->name} Plan",
                    'reference_id' => $newInvestment->id
                ]);
            }

            if ($fromBonus > 0) {
                Transaction::create([
                    'user_id' => $lockedUser->id,
                    'type' => 'investment',
                    'amount' => $fromBonus,
                    'wallet_type' => 'bonus_balance',
                    'status' => 'completed',
                    'description' => "Investment in {$plan->name} Plan (Bonus Balance)",
                    'reference_id' => $newInvestment->id
                ]);
            }

            return $newInvestment;
        });

        if (!$investment) {
            return back()->withErrors(['amount' => 'Insufficient funds.']);
        }

        // Trigger referral multi-level commissions outside transaction
        $this->referralService->distributeCommission(Auth::user(), $amount);

        return redirect()->route('dashboard')->with('success', 'Investment activated successfully! Commissions distributed to team.');
    }
}
