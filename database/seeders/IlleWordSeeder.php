<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class IlleWordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        \DB::table('illegal_words')->insert([
            [
                'name' => 'religion',
                'type' => 'horse',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'homeless',
                'type' => 'horse',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
