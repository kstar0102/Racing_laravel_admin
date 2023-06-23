<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $now = Carbon::now();
        DB::table('stalls')->insert([
            [
                'name' => '国沢厩舎',
                'host' => '../../assets/images/avatars/1.png',
                'moto' => '「馬を大切に!」がモットー !',
                'price' => '1000',
                'possable' => '併走',
                'volumn' => '10',
                'horses' => '0',
                'etc' => 'GIレース',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => '木藤厩舎',
                'host' => '../../assets/images/avatars/2.png',
                'moto' => '「スパルタ!」がモットー!',
                'price' => '1000',
                'possable' => '坂路',
                'volumn' => '10',
                'horses' => '0',
                'etc' => 'ダート馬',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => '堀塚厩舎',
                'host' => '../../assets/images/avatars/3.png',
                'moto' => '「じっくりと!」がモットー!',
                'price' => '1000',
                'possable' => '併走',
                'volumn' => '10',
                'horses' => '0',
                'etc' => 'GIレース',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => '矢道厩舎',
                'host' => '../../assets/images/avatars/5.png',
                'moto' => '「世界制覇! 」がモットー!',
                'price' => '1000',
                'possable' => '併走',
                'volumn' => '10',
                'horses' => '0',
                'etc' => 'GIレース',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => '池貝廳舍',
                'host' => '../../assets/images/avatars/6.png',
                'moto' => '「長時間調教!」 がモットー!',
                'price' => '1000',
                'possable' => 'ブール',
                'volumn' => '10',
                'horses' => '0',
                'etc' => '長距離',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => '中外田厩舎',
                'host' => '../../assets/images/avatars/7.png',
                'moto' => '「仕上げ早く!」 がモットー!',
                'price' => '1000',
                'possable' => '坂路',
                'volumn' => '10',
                'horses' => '0',
                'etc' => '短距離',
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}
