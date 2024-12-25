<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoansTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('loans')->insert([
            [
                'farmer_id' => 1,
                'amount' => 5000.00,
                'interest_rate' => 5.5,
                'repayment_duration' => 12,
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'farmer_id' => 2,
                'amount' => 10000.00,
                'interest_rate' => 6.0,
                'repayment_duration' => 24,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'farmer_id' => 3,
                'amount' => 7000.00,
                'interest_rate' => 5.0,
                'repayment_duration' => 18,
                'status' => 'rejected',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

