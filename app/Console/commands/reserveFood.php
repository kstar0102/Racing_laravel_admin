<?php

namespace App\Console\Commands;

use App\Models\GrowHorse;
use App\Models\Horse;
use App\Models\User;
use Carbon\Carbon;
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
            ->where('etc', '0')
            ->groupBy('horse_id')
            ->get();

        $user_id = '';
        $pt = '';
        $what = '';
        $grow = '';
        $age = '';
        $horse_id = '';

        foreach ($data as $key => $value) {
            $food_name = Foods::where('horse_id', $value->horse_id)->where('order', $value->order_num)->get();
            foreach ($food_name as $key_val => $v) {
                $type = $v->food_type;
                if ($type == 'grazing') {
                    $user_id = $v->user_id;
                    $pt = $v->price;
                    $what = preg_replace('/\([^)]*\)/', '', $v->food_name);
                    $horse_id = $v->horse_id;
                    $horse_val = Horse::where('id', $horse_id)->first();
                    $grow = $horse_val->growth;
                    $age = substr($horse_val->age, 1, 1);

                    //check peak value
                    switch ($grow) {
                        case '早熟':
                            $speed_max = 50;
                            $strength_max = 50;
                            $stamina_max = 10;
                            $moment_max = 50;
                            $condition_max = 50;
                            $health_max = 50;
                            $age_max = 2;
                            break;

                        case '早め':
                            $speed_max = 100;
                            $strength_max = 100;
                            $stamina_max = 10;
                            $moment_max = 80;
                            $condition_max = 100;
                            $health_max = 99;
                            $age_max = 3;
                            break;

                        case '普通':
                            $speed_max = 150;
                            $strength_max = 150;
                            $stamina_max = 10;
                            $moment_max = 80;
                            $condition_max = 150;
                            $health_max = 99;
                            $age_max = 4;
                            break;

                        case '持続':
                            $speed_max = 170;
                            $strength_max = 170;
                            $stamina_max = 10;
                            $moment_max = 80;
                            $condition_max = 170;
                            $health_max = 99;
                            $age_max = 4;
                            break;

                        case '遅め':
                            $speed_max = 170;
                            $strength_max = 200;
                            $stamina_max = 10;
                            $moment_max = 80;
                            $condition_max = 185;
                            $health_max = 99;
                            $age_max = 5;
                            break;

                        case '晩成':
                            $speed_max = 170;
                            $strength_max = 170;
                            $stamina_max = 10;
                            $moment_max = 80;
                            $condition_max = 170;
                            $health_max = 99;
                            $age_max = 6;
                            break;

                        default:
                            $speed_max = 0;
                            $strength_max = 0;
                            $stamina_max = 0;
                            $moment_max = 0;
                            $condition_max = 0;
                            $health_max = 0;
                            $age_max = 0;
                            break;
                    }
                    $input_speed = 0;
                    $input_strength = 0;
                    $input_stamina = 0;
                    $input_condition = 0;
                    $input_moment = 0;
                    $input_health = 0;

                    if ($age <= $age_max) {
                        $grow_horse = GrowHorse::where('horse_id', $horse_id)->first();
                        if ($grow_horse->speed_b >= $speed_max) {
                            $input_speed = 1;
                        } elseif ($grow_horse->strength_b >= $strength_max) {
                            $input_strength = 1;
                        } elseif ($grow_horse->stamina_b >= $stamina_max) {
                            $input_stamina = 1;
                        } elseif ($grow_horse->condition_b_b == $condition_max) {
                            $input_condition = 1;
                        } elseif ($grow_horse->moment_b >= $moment_max) {
                            $input_moment = 1;
                        } elseif ($grow_horse->health_b >= $health_max) {

                            $input_health = 1;
                        }
                    }

                    // get cal happy and tired values
                    $happy_value = Horse::select('happy')->where('id', $horse_id)->first();
                    $tired_value = Horse::select('tired')->where('id', $horse_id)->first();
                    $direction_value = Horse::select('direction')->where('id', $horse_id)->first();

                    $cal_happy = $happy_value->happy;
                    $cal_tired = $tired_value->tired;
                    $cal_direction = $direction_value->direction;

                    // start to calculate
                    $element_1 = 0;

                    if ($cal_happy >= 9) {
                        $cal_direction = 0;
                    } else if ($cal_happy <= -9) {
                        $cal_direction = 1;
                    }

                    if ($cal_direction == 1) {
                        $element_2 = 1;
                    } else if ($cal_direction == 0) {
                        $element_2 = -1;
                    }
                    $element_3 = 0;

                    if ($what == "芝" || $what == "ダート" || $what == "ウッドチップ") {
                        if ($pt == "1") {
                            $element_1 = 1;
                            $element_3 = 1;
                        } else if ($pt == "3") {
                            $element_1 = 2;
                            $element_3 = 2;
                        } else {
                            $element_1 = 3;
                            $element_3 = 3;
                        }
                        if ($cal_tired >= 20) {
                            $element_3 = 20 - $cal_tired;
                        }

                        if ($what == "芝") {
                            if ($input_speed == 1) {
                                $element_1 = 0;
                            } else {
                                GrowHorse::where('horse_id', $horse_id)->update([
                                    'speed_b' => \DB::raw('speed_b + ' . $element_1)
                                ]);
                            }

                            Horse::where('id', $horse_id)->update([
                                'speed_b' => \DB::raw('speed_b + ' . $element_1),
                                'happy' => \DB::raw('happy + ' . $element_2),
                                'tired' => \DB::raw('tired + ' . $element_3),
                                'direction' => $cal_direction
                            ]);


                        } else if ($what == "ダート") {
                            if ($input_strength == 1) {
                                $element_1 = 0;
                            } else {
                                GrowHorse::where('horse_id', $horse_id)->update([
                                    'strength_b' => \DB::raw('strength_b + ' . $element_1)
                                ]);
                            }

                            Horse::where('id', $horse_id)->update([
                                'strength_b' => \DB::raw('strength_b + ' . $element_1),
                                'happy' => \DB::raw('happy + ' . $element_2),
                                'tired' => \DB::raw('tired + ' . $element_3),
                                'direction' => $cal_direction
                            ]);

                        } else {
                            if ($input_condition == 1) {
                                $element_1 = 0;
                            } else {
                                GrowHorse::where('horse_id', $horse_id)->update([
                                    'condition_b' => \DB::raw('condition_b + ' . $element_1)
                                ]);
                            }

                            Horse::where('id', $horse_id)->update([
                                'condition_b' => \DB::raw('condition_b + ' . $element_1),
                                'happy' => \DB::raw('happy + ' . $element_2),
                                'tired' => \DB::raw('tired + ' . $element_3),
                                'direction' => $cal_direction
                            ]);
                        }
                    }

                    if ($what == "併走" || $what == "坂路" || $what == "プール") {
                        if ($pt == "3") {
                            $element_1 = 1;
                            $element_3 = 1;
                        } else if ($pt == "5") {
                            $element_1 = 2;
                            $element_3 = 2;
                        } else {
                            $element_1 = 3;
                            $element_3 = 3;
                        }

                        if ($cal_tired >= 20) {
                            $element_3 = 20 - $cal_tired;
                        }

                        if ($what == "併走") {
                            if ($input_stamina == 1) {
                                $element_1 = 0;
                            } else {
                                GrowHorse::where('id', $horse_id)->update([
                                    'stamina_b' => \DB::raw('stamina_b + ' . $element_1)
                                ]);
                            }
                            Horse::where('id', $horse_id)->update([
                                'stamina_b' => \DB::raw('stamina_b + ' . $element_1),
                                'happy' => \DB::raw('happy + ' . $element_2),
                                'tired' => \DB::raw('tired + ' . $element_3),
                                'direction' => $cal_direction
                            ]);

                        } else if ($what == "坂路") {
                            if ($input_moment == 1) {
                                $element_1 == 0;
                            } else {
                                GrowHorse::where('id', $horse_id)->update([
                                    'moment_b' => \DB::raw('moment_b + ' . $element_1)
                                ]);
                            }
                            Horse::where('id', $horse_id)->update([
                                'moment_b' => \DB::raw('moment_b + ' . $element_1),
                                'happy' => \DB::raw('happy + ' . $element_2),
                                'tired' => \DB::raw('tired + ' . $element_3),
                                'direction' => $cal_direction
                            ]);

                        } else {
                            if ($input_health == 1) {
                                $element_1 = 0;
                            } else {
                                GrowHorse::where('horse_id', $horse_id)->update([
                                    'health_b' => \DB::raw('health_b + ' . $element_1)
                                ]);
                            }
                            Horse::where('id', $horse_id)->update([
                                'health_b' => \DB::raw('health_b + ' . $element_1),
                                'happy' => \DB::raw('happy + ' . $element_2),
                                'tired' => \DB::raw('tired + ' . $element_3),
                                'direction' => $cal_direction
                            ]);
                        }
                    }
                    if ($what == "スベシャル") {
                        if ($cal_happy >= 9) {
                            $cal_direction = 0;
                        } else if ($cal_happy <= -9) {
                            $cal_direction = 1;
                        }

                        if ($cal_direction == 1) {
                            $element_2 = 5;
                        } else if ($cal_direction == 0) {
                            $element_2 = -5;
                        }

                        $element_3 = 5; // when master the tired is raing 5

                        if ($cal_tired >= 20) {
                            $element_3 = 20 - $cal_tired;
                        }

                        $input_special_speed = 5;
                        $input_special_strength = 5;
                        $input_special_stamina = 5;
                        $input_special_moment = 5;

                        if ($input_speed = 1) {
                            $input_special_speed = 0;
                        } else if ($input_strength == 1) {
                            $input_special_strength = 0;
                        } else if ($input_stamina == 1) {
                            $input_special_stamina = 0;
                        } else if ($input_moment == 1) {
                            $input_special_moment = 0;
                        } else {
                            GrowHorse::where('horse_id', $horse_id)->update([
                                'speed_b' => \DB::raw('speed_b + 5'),
                                'strength_b' => \DB::raw('strength_b + 5'),
                                'stamina_b' => \DB::raw('stamina_b + 5'),
                                'moment_b' => \DB::raw('moment_b + 5')
                            ]);
                        }

                        Horse::where('id', $horse_id)->update([
                            'speed_b' => \DB::raw('speed_b + ' . $input_special_speed),
                            'strength_b' => \DB::raw('strength_b + ' . $input_special_strength),
                            'stamina_b' => \DB::raw('stamina_b + ' . $input_special_stamina),
                            'moment_b' => \DB::raw('moment_b + ' . $input_special_moment),
                            'happy' => \DB::raw('happy + ' . $element_2),
                            'tired' => \DB::raw('tired + ' . $element_3),
                            'direction' => $cal_direction
                        ]);
                    }

                    Horse::where('id', $horse_id)->update(['etc' => 1]);
                    User::where('id', $user_id)->update(['user_pt' => \DB::raw('user_pt -' . $pt)]);
                } else if ($type == "fodder") {
                    $horse_id = $v->horse_id;
                    $pt = $v->price;
                    $what = $v->food_name;
                    $user_id = $v->user_id;

                    $happy_value = Horse::select('happy')->where('id', $horse_id)->first();
                    $tired_value = Horse::select('tired')->where('id', $horse_id)->first();
                    $direction_value = Horse::select('direction')->where('id', $horse_id)->first();

                    $cal_happy = $happy_value->happy;
                    $cal_direction = $direction_value->direction;

                    if ($cal_happy >= 9) {
                        $cal_direction = 0;
                    } else if ($cal_happy <= -9) {
                        $cal_direction = 1;
                    }

                    $element = 0;
                    switch ($pt) {
                        case '1':
                            if ($cal_direction == 1) {
                                $element = 1;
                            } else if ($cal_direction == 0) {
                                $element = -1;
                            }
                            break;
                        case '3':
                            if ($cal_direction == 1) {
                                $element = 2;
                            } else if ($cal_direction == 0) {
                                $element = -2;
                            }
                            break;
                        case '5':
                            if ($cal_direction == 1) {
                                $element = 3;
                            } else if ($cal_direction == 0) {
                                $element = -3;
                            }
                            break;
                        case '2':
                            $element = -1;
                            break;
                        case '4':
                            $element = -2;
                            break;
                        case '6':
                            $element = -3;
                            break;
                        default:
                            return response()->json(['message' => 'invalid value for pt'], 422);
                    }

                    // Refactored update statement

                    if ($pt == 1 || $pt == 3 || $pt == 5) {
                        Horse::where('id', $horse_id)->update([
                            'happy' => \DB::raw('happy + ' . $element),
                            'direction' => $cal_direction
                        ]);
                    } else if ($pt == 2 || $pt == 4 || $pt == 6) {
                        $check_tired = Horse::select('tired')->where('id', $horse_id)->first();
                        if ($check_tired->tired < 0) {
                            $element = 0;
                        }
                        Horse::where('id', $horse_id)->update([
                            'tired' => \DB::raw('tired + ' . $element),
                            'direction' => $cal_direction
                        ]);
                    }

                    // the histroy of feeding start
                    $today = Carbon::now();
                    $results = \DB::table('horse_train_history')
                        ->where('horse_id', $horse_id)
                        ->get();

                    if ($results) {
                        $count = 0;
                        foreach ($results as $key => $ttt) {
                            if ($ttt->what == $what) {
                                $count += 1;
                                if ($ttt->number_horse < 3) {
                                    \DB::table('horse_train_history')
                                        ->where('horse_id', $horse_id)
                                        ->where('what', $what)
                                        ->update(
                                            array(
                                                'time_t' => $today->toTimeString(),
                                                'number_horse' => \DB::raw('number_horse + 1')
                                            )
                                        );
                                }
                            }
                        }
                        if ($count == 0) {
                            \DB::table('horse_train_history')->insert(
                                array('horse_id' => $horse_id, 'date_t' => $today->toDateString(), 'time_t' => $today->toTimeString(), 'date_type' => "normal", 'what' => $what, 'number_horse' => 1)
                            );
                        }
                    } else {
                        \DB::table('horse_train_history')->insert(
                            array('horse_id' => $horse_id, 'date_t' => $today->toDateString(), 'time_t' => $today->toTimeString(), 'date_type' => "normal", 'what' => $what, 'number_horse' => 1)
                        );
                    }
                    // the histroy of feeding end

                    // Refactored update statement
                    User::where('id', $user_id)->update([
                        'user_pt' => \DB::raw('user_pt - ' . $pt)
                    ]);

                }
            }
            Foods::where('horse_id', $value->horse_id)
                ->where('order', $value->order_num)
                ->update(['etc' => '1']);
        }
    }
}