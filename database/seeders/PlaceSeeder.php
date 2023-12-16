<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $now = Carbon::now();
        DB::table('places')->insert([
            [
                'name' => '東京',
            ],
            [
                'name' => '中山',
            ],
            [
                'name' => '京都',
            ],
            [
                'name' => '阪神',
            ],
            [
                'name' => '中京',
            ],
            [
                'name' => '福島',
            ],
            [
                'name' => '新潟',
            ],
            [
                'name' => '小倉',
            ],
            [
                'name' => '札幌',
            ],
            [
                'name' => '函館',
            ],
            [
                'name' => 'ロンシャン',
            ],
            [
                'name' => '帯広',
            ],
            [
                'name' => '門別',
            ],
            [
                'name' => '盛岡',
            ],
            [
                'name' => '水沢',
            ],
            [
                'name' => '浦和',
            ],
            [
                'name' => '船橋',
            ],
            [
                'name' => '大井',
            ],
            [
                'name' => '川崎',
            ],
            [
                'name' => '金沢',
            ],
            [
                'name' => '笠松',
            ],
            [
                'name' => '名古屋',
            ],
            [
                'name' => '園田',
            ],
            [
                'name' => '姫路',
            ],
            [
                'name' => '高知',
            ],
            [
                'name' => '佐賀',
            ],
        ]);
    }
}
