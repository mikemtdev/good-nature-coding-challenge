<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class FarmersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('farmers')->insert([
            [
                'name' => 'John Doe',
                'phone' => '1234567890',
                'location' => 'Village A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'phone' => '0987654321',
                'location' => 'Village B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Michael Johnson',
                'phone' => '1122334455',
                'location' => 'Village C',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

