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
                'level' => 100,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'user1',
                'email' => 'user1@gmail.com',
                'login_id' => 'user1',
                'role' => '0',
                'password' => bcrypt('secret'),
                'user_pt' => 500000,
                'level' => 100,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'user2',
                'email' => 'user2@gmail.com',
                'login_id' => 'user2',
                'role' => '0',
                'password' => bcrypt('secret'),
                'user_pt' => 500000,
                'level' => 100,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'user3',
                'email' => 'user3@gmail.com',
                'login_id' => 'user3',
                'role' => '0',
                'password' => bcrypt('secret'),
                'user_pt' => 500000,
                'level' => 100,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'user4',
                'email' => 'user4@gmail.com',
                'login_id' => 'user4',
                'role' => '0',
                'password' => bcrypt('secret'),
                'user_pt' => 500000,
                'level' => 100,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'user5',
                'email' => 'user5@gmail.com',
                'login_id' => 'user5',
                'role' => '0',
                'password' => bcrypt('secret'),
                'user_pt' => 500000,
                'level' => 100,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'user6',
                'email' => 'user6@gmail.com',
                'login_id' => 'user6',
                'role' => '0',
                'password' => bcrypt('secret'),
                'user_pt' => 500000,
                'level' => 100,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'user7',
                'email' => 'user7@gmail.com',
                'login_id' => 'user7',
                'role' => '0',
                'password' => bcrypt('secret'),
                'user_pt' => 500000,
                'level' => 100,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'user8',
                'email' => 'user8@gmail.com',
                'login_id' => 'user8',
                'role' => '0',
                'password' => bcrypt('secret'),
                'user_pt' => 500000,
                'level' => 100,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'user9',
                'email' => 'user9@gmail.com',
                'login_id' => 'user9',
                'role' => '0',
                'password' => bcrypt('secret'),
                'user_pt' => 500000,
                'level' => 100,
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}
