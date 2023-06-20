<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $now = Carbon::now();
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@derby.com',
                'login_id' => 'admin',
                'role' => '1',
                'password' => bcrypt('secret'),
                'user_pt' => 500000,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'user1',
                'email' => 'user1@gmail.com',
                'login_id' => 'user1',
                'role' => '0',
                'password' => bcrypt('secret'),
                'user_pt' => 5000,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
