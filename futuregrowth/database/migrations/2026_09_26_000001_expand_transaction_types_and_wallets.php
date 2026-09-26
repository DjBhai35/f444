<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Ensure wallets table has salary_balance
        if (Schema::hasTable('wallets')) {
            Schema::table('wallets', function (Blueprint $table) {
                if (!Schema::hasColumn('wallets', 'salary_balance')) {
                    $table->decimal('salary_balance', 16, 2)->default(0)->after('bonus_balance');
                }
            });
        }

        // 2. Ensure transactions table type and wallet_type support all valid platform types
        if (Schema::hasTable('transactions')) {
            $driver = DB::getDriverName();
            if ($driver === 'mysql') {
                try {
                    DB::statement("ALTER TABLE transactions MODIFY COLUMN type VARCHAR(32) NOT NULL DEFAULT 'deposit'");
                    DB::statement("ALTER TABLE transactions MODIFY COLUMN wallet_type VARCHAR(32) NULL");
                } catch (\Throwable $e) {}
            } else {
                try {
                    Schema::table('transactions', function (Blueprint $table) {
                        $table->string('type', 32)->default('deposit')->change();
                        $table->string('wallet_type', 32)->nullable()->change();
                    });
                } catch (\Throwable $e) {}
            }
        }
    }

    public function down(): void
    {
        // Additive migration: preserve data on rollback
    }
};
