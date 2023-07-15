<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PrizeMoneySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        \DB::table('prize_money')->insert([
            [
                'race_type' => '新馬',
                'rank' => '1',
                'money' => '700',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '新馬',
                'rank' => '2',
                'money' => '300',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '新馬',
                'rank' => '3',
                'money' => '200',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '新馬',
                'rank' => '4',
                'money' => '180',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '新馬',
                'rank' => '5',
                'money' => '160',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '新馬',
                'rank' => '6',
                'money' => '140',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '新馬',
                'rank' => '7',
                'money' => '120',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '新馬',
                'rank' => '8',
                'money' => '110',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '新馬',
                'rank' => 'any',
                'money' => '50',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            //新馬
            [
                'race_type' => '未勝利',
                'rank' => '1',
                'money' => '400',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '未勝利',
                'rank' => '2',
                'money' => '200',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '未勝利',
                'rank' => '3',
                'money' => '100',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '未勝利',
                'rank' => '4',
                'money' => '80',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '未勝利',
                'rank' => '5',
                'money' => '60',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '未勝利',
                'rank' => '6',
                'money' => '40',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '未勝利',
                'rank' => '7',
                'money' => '20',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '未勝利',
                'rank' => '8',
                'money' => '10',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '未勝利',
                'rank' => 'any',
                'money' => '5',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            //未勝利
            [
                'race_type' => '1勝クラス',
                'rank' => '1',
                'money' => '700',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '1勝クラス',
                'rank' => '2',
                'money' => '300',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '1勝クラス',
                'rank' => '3',
                'money' => '200',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '1勝クラス',
                'rank' => '4',
                'money' => '180',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '1勝クラス',
                'rank' => '5',
                'money' => '160',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '1勝クラス',
                'rank' => '6',
                'money' => '140',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '1勝クラス',
                'rank' => '7',
                'money' => '120',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '1勝クラス',
                'rank' => '8',
                'money' => '110',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '1勝クラス',
                'rank' => 'any',
                'money' => '50',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            //2勝クラス
            [
                'race_type' => '2勝クラス',
                'rank' => '1',
                'money' => '1000',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '2勝クラス',
                'rank' => '2',
                'money' => '400',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '2勝クラス',
                'rank' => '3',
                'money' => '300',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '2勝クラス',
                'rank' => '4',
                'money' => '280',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '2勝クラス',
                'rank' => '5',
                'money' => '260',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '2勝クラス',
                'rank' => '6',
                'money' => '240',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '2勝クラス',
                'rank' => '7',
                'money' => '220',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '2勝クラス',
                'rank' => '8',
                'money' => '210',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '2勝クラス',
                'rank' => 'any',
                'money' => '100',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            //3勝クラス
            [
                'race_type' => '3勝クラス',
                'rank' => '1',
                'money' => '1300',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '3勝クラス',
                'rank' => '2',
                'money' => '600',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '3勝クラス',
                'rank' => '3',
                'money' => '450',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '3勝クラス',
                'rank' => '4',
                'money' => '400',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '3勝クラス',
                'rank' => '5',
                'money' => '350',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '3勝クラス',
                'rank' => '6',
                'money' => '300',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '3勝クラス',
                'rank' => '7',
                'money' => '280',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '3勝クラス',
                'rank' => '8',
                'money' => '250',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '3勝クラス',
                'rank' => 'any',
                'money' => '150',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            //OP
            [
                'race_type' => 'OP',
                'rank' => '1',
                'money' => '1800',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'OP',
                'rank' => '2',
                'money' => '800',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'OP',
                'rank' => '3',
                'money' => '650',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'OP',
                'rank' => '4',
                'money' => '500',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'OP',
                'rank' => '5',
                'money' => '420',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'OP',
                'rank' => '6',
                'money' => '380',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'OP',
                'rank' => '7',
                'money' => '340',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'OP',
                'rank' => '8',
                'money' => '300',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'OP',
                'rank' => 'any',
                'money' => '200',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            //GIII
            [
                'race_type' => 'GIII',
                'rank' => '3000',
                'money' => '1800',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'GIII',
                'rank' => '2',
                'money' => '1200',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'GIII',
                'rank' => '3',
                'money' => '950',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'GIII',
                'rank' => '4',
                'money' => '800',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'GIII',
                'rank' => '5',
                'money' => '650',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'GIII',
                'rank' => '6',
                'money' => '580',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'GIII',
                'rank' => '7',
                'money' => '500',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'GIII',
                'rank' => '8',
                'money' => '420',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'GIII',
                'rank' => 'any',
                'money' => '250',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            //GII
            [
                'race_type' => 'GII',
                'rank' => '1',
                'money' => '4500',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'GII',
                'rank' => '2',
                'money' => '2000',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'GII',
                'rank' => '3',
                'money' => '1700',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'GII',
                'rank' => '4',
                'money' => '1400',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'GII',
                'rank' => '5',
                'money' => '1100',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'GII',
                'rank' => '6',
                'money' => '850',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'GII',
                'rank' => '7',
                'money' => '700',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'GII',
                'rank' => '8',
                'money' => '620',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'GII',
                'rank' => 'any',
                'money' => '300',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            //GI
            [
                'race_type' => 'GI',
                'rank' => '1',
                'money' => '10000',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'GI',
                'rank' => '2',
                'money' => '4000',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'GI',
                'rank' => '3',
                'money' => '2700',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'GI',
                'rank' => '4',
                'money' => '2400',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'GI',
                'rank' => '5',
                'money' => '2100',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'GI',
                'rank' => '6',
                'money' => '1850',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'GI',
                'rank' => '7',
                'money' => '1700',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'GI',
                'rank' => '8',
                'money' => '1620',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => 'GI',
                'rank' => 'any',
                'money' => '400',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            //海外GI
            [
                'race_type' => '海外GI',
                'rank' => '1',
                'money' => '15000',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '海外GI',
                'rank' => '2',
                'money' => '6500',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '海外GI',
                'rank' => '3',
                'money' => '5000',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '海外GI',
                'rank' => '4',
                'money' => '4300',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '海外GI',
                'rank' => '5',
                'money' => '3500',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '海外GI',
                'rank' => '6',
                'money' => '2900',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '海外GI',
                'rank' => '7',
                'money' => '2500',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '海外GI',
                'rank' => '8',
                'money' => '2000',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '海外GI',
                'rank' => 'any',
                'money' => '500',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            //隠しレース
            [
                'race_type' => '海外GI',
                'rank' => '1',
                'money' => '30000',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '海外GI',
                'rank' => '2',
                'money' => '20000',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '海外GI',
                'rank' => '3',
                'money' => '10000',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '海外GI',
                'rank' => '4',
                'money' => '7500',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '海外GI',
                'rank' => '5',
                'money' => '5000',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '海外GI',
                'rank' => '6',
                'money' => '4200',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '海外GI',
                'rank' => '7',
                'money' => '3500',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '海外GI',
                'rank' => '8',
                'money' => '3000',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'race_type' => '海外GI',
                'rank' => 'any',
                'money' => '1000',
                'etc' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}
