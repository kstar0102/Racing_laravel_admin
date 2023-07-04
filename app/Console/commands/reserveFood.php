<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ReserveFood as Foods;

class reserveFood extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reserve:food';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    //     $data = Foods::select('food_name')
    //     ->groupBy('horse_id')
    //     ->get();
    public function handle()
    {
        $data = \DB::table('reserve_food')
            ->select('horse_id', \DB::raw('MIN(`order`) as order_num'))
            ->groupBy('horse_id')
            ->get();

        $food_name_list = [];
        foreach ($data as $key => $value) {
            $food_name = Foods::select('food_name')->where('horse_id', $value->horse_id)->where('order', $value->order_num)->get();
            array_push($food_name_list, $food_name);
            Foods::where('horse_id', $value->horse_id)
                ->where('order', $value->order_num)
                ->delete();
        }


        // for ($i = 0; $i < count($food_name_list); $i++) {
        //     if ($food_name_list[$i]->food_name == "芝" || $food_name_list[$i]->food_name == "ダート" || $food_name_list[$i]->food_name == "ウッドチップ") {

        //             $element_1 = 1;
        //             $element_3 = 1;

        //         if ($food_name_list[$i]->food_name == "芝") {
        //             Horse::where('id', $horse_id)->update([
        //                 'speed_b' => \DB::raw('speed_b + ' . $element_1),
        //                 'happy' => \DB::raw('happy + ' . $element_2),
        //                 'tired' => \DB::raw('tired + ' . $element_3),
        //                 'direction' => $cal_direction
        //             ]);

        //         } else if ($food_name_list[$i]->food_name == "ダート") {
        //             Horse::where('id', $horse_id)->update([
        //                 'strength_b' => \DB::raw('strength_b + ' . $element_1),
        //                 'happy' => \DB::raw('happy + ' . $element_2),
        //                 'tired' => \DB::raw('tired + ' . $element_3),
        //                 'direction' => $cal_direction
        //             ]);

        //         } else {
        //             Horse::where('id', $horse_id)->update([
        //                 'condition_b' => \DB::raw('condition_b + ' . $element_1),
        //                 'happy' => \DB::raw('happy + ' . $element_2),
        //                 'tired' => \DB::raw('tired + ' . $element_3),
        //                 'direction' => $cal_direction
        //             ]);
        //             ///
        //             // GrowHorse::where('id', $horse_id)->update([
        //             //     'condition_b' => \DB::raw('condition_b + ' . $element_1)
        //             // ]);
        //         }
        //     }

        //     if ($food_name_list[$i]->food_name == "併走" || $food_name_list[$i]->food_name == "坂路" || $food_name_list[$i]->food_name == "プール") {
        //         if ($pt == "3") {
        //             $element_1 = 1;
        //             $element_3 = 1;
        //         } else if ($pt == "5") {
        //             $element_1 = 2;
        //             $element_3 = 2;
        //         } else {
        //             $element_1 = 3;
        //             $element_3 = 3;
        //         }

        //         if ($cal_tired >= 20) {
        //             $element_3 = 20 - $cal_tired;
        //         }

        //         if ($food_name_list[$i]->food_name == "併走") {
        //             Horse::where('id', $horse_id)->update([
        //                 'stamina_b' => \DB::raw('stamina_b + ' . $element_1),
        //                 'happy' => \DB::raw('happy + ' . $element_2),
        //                 'tired' => \DB::raw('tired + ' . $element_3),
        //                 'direction' => $cal_direction
        //             ]);

        //             ///
        //             // GrowHorse::where('id', $horse_id)->update([
        //             //     'stamina_b' => \DB::raw('stamina_b + ' . $element_1)
        //             // ]);

        //         } else if ($food_name_list[$i]->food_name == "坂路") {
        //             Horse::where('id', $horse_id)->update([
        //                 'moment_b' => \DB::raw('moment_b + ' . $element_1),
        //                 'happy' => \DB::raw('happy + ' . $element_2),
        //                 'tired' => \DB::raw('tired + ' . $element_3),
        //                 'direction' => $cal_direction
        //             ]);

        //             ///
        //             // GrowHorse::where('id', $horse_id)->update([
        //             //     'moment_b' => \DB::raw('moment_b + ' . $element_1)
        //             // ]);

        //         } else {
        //             Horse::where('id', $horse_id)->update([
        //                 'health_b' => \DB::raw('health_b + ' . $element_1),
        //                 'happy' => \DB::raw('happy + ' . $element_2),
        //                 'tired' => \DB::raw('tired + ' . $element_3),
        //                 'direction' => $cal_direction
        //             ]);

        //             ///
        //             // GrowHorse::where('id', $horse_id)->update([
        //             //     'health_b' => \DB::raw('health_b + ' . $element_1)
        //             // ]);
        //         }
        //     }
        //     if ($food_name_list[$i]->food_name == "スベシャル") {
        //         if ($cal_happy >= 9) {
        //             $cal_direction = 0;
        //         } else if ($cal_happy <= -9) {
        //             $cal_direction = 1;
        //         }

        //         if ($cal_direction == 1) {
        //             $element_2 = 5;
        //         } else if ($cal_direction == 0) {
        //             $element_2 = -5;
        //         }

        //         $element_3 = 5; // when master the tired is raing 5

        //         if ($cal_tired >= 20) {
        //             $element_3 = 20 - $cal_tired;
        //         }

        //         Horse::where('id', $horse_id)->update([
        //             'speed_b' => \DB::raw('speed_b + 5'),
        //             'strength_b' => \DB::raw('strength_b + 5'),
        //             'stamina_b' => \DB::raw('stamina_b + 5'),
        //             'moment_b' => \DB::raw('moment_b + 5'),
        //             'happy' => \DB::raw('happy + ' . $element_2),
        //             'tired' => \DB::raw('tired + ' . $element_3),
        //             'direction' => $cal_direction
        //         ]);

        //         ///
        //         // GrowHorse::where('id', $horse_id)->update([
        //         //     'speed_b' => \DB::raw('speed_b + 5'),
        //         //     'strength_b' => \DB::raw('strength_b + 5'),
        //         //     'stamina_b' => \DB::raw('stamina_b + 5'),
        //         //     'moment_b' => \DB::raw('moment_b + 5')
        //         // ]);
        //     }
        // }


    }
}