<?php

namespace App\Http\Controllers;

use App\Models\GrowHorse;
use App\Models\IllegalWord;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Horse;
use App\Models\Lineage;
use App\Models\User;
use App\Models\Pasture;
use App\Models\trainHistory;
use App\Models\StallSp;

class HorseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Horse::all();
        return view('admin.content.horse', ['horses' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputData = $request->input('data');
        $inputName = $inputData['name'];
        $user_id = $inputData['user_id'];
        $pasture_id = $inputData['pasture_id'];
        $cData = $inputData['data'];
        $count = 0;
        $total_price = 0;
        for ($i = 0; $i < count($cData); $i++) {
            $total_price += $cData[$i]['price'];
            $count++;
            $illegal_name = IllegalWord::where('name', $inputName[$i])->get();
            if ($illegal_name->count() > 0) {
                return response()->json(['message' => '禁止ワード [' . $inputName[$i] . ']']);
            }
            $horse = new Horse;
            $horse->name = $inputName[$i];
            $horse->age = $cData[$i]['age'];
            $horse->type = "";
            $horse->class = "";
            $horse->place = "pasture";
            $horse->distance_max = $cData[$i]['distance_max'];
            $horse->distance_min = $cData[$i]['distance_min'];
            $horse->color = $cData[$i]['color'];
            $horse->gender = $cData[$i]['gender'];
            $horse->growth = $cData[$i]['growth'];
            $horse->ground = $cData[$i]['ground'];
            $horse->quality_leg = $cData[$i]['quality_leg'];
            $horse->speed_b = $cData[$i]['speed_b'];
            $horse->strength_b = $cData[$i]['strength_b'];
            $horse->moment_b = $cData[$i]['moment_b'];
            $horse->stamina_b = $cData[$i]['stamina_b'];
            $horse->condition_b = $cData[$i]['condition_b'];
            $horse->health_b = $cData[$i]['health_b'];
            $horse->speed_w = $cData[$i]['speed_w'];
            $horse->strength_w = $cData[$i]['strength_w'];
            $horse->moment_w = $cData[$i]['moment_w'];
            $horse->stamina_w = $cData[$i]['stamina_w'];
            $horse->condition_w = $cData[$i]['condition_w'];
            $horse->health_w = $cData[$i]['health_w'];
            $horse->happy = "10";
            $horse->tired = "0";
            $horse->direction = 1;
            $horse->price = $cData[$i]['price'];
            $horse->hidden = $cData[$i]['hidden'];
            $horse->state = 1;
            $horse->triple_crown = $cData[$i]['triple_crown'];

            $horse->f_sys = $cData[$i]['f_sys'];
            $horse->f_name = $cData[$i]['f_name'];
            $horse->f_factor = $cData[$i]['f_factor'];
            $horse->m_sys = $cData[$i]['m_sys'];
            $horse->m_name = $cData[$i]['m_name'];

            $horse->f_f_sys = $cData[$i]['f_f_sys'];
            $horse->f_f_name = $cData[$i]['f_f_name'];
            $horse->f_f_factor = $cData[$i]['f_f_factor'];
            $horse->f_m_sys = $cData[$i]['f_m_sys'];
            $horse->f_m_name = $cData[$i]['f_m_name'];

            $horse->m_f_sys = $cData[$i]['m_f_sys'];
            $horse->m_f_name = $cData[$i]['m_f_name'];
            $horse->m_f_factor = $cData[$i]['m_f_factor'];
            $horse->m_m_sys = $cData[$i]['m_m_sys'];
            $horse->m_m_name = $cData[$i]['m_m_name'];

            $horse->user_id = $user_id;
            $horse->pasture_id = $pasture_id;
            $horse->stall_id = 'none';
            $horse->save();
        }
        User::where('id', $user_id)->update(['user_pt' => \DB::raw('user_pt -' . $total_price)]);
        Pasture::where('id', $pasture_id)->update(['horses' => $count]);
        $horses = Horse::where('user_id', $user_id)->where('pasture_id', $pasture_id)->get();
        return response()->json(['data' => $horses]);
    }

    /**
     * Display the specified resource.(pasture)
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->input('user_id');
        $pasture_id = $request->input('pasture_id');
        $data = Horse::where('user_id', $id)->where('pasture_id', $pasture_id)->where('place', 'pasture')->get();
        return response()->json(['data' => $data]);
    }

    /**
     * Display the specified resource.(stall)
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showStall(Request $request)
    {
        //$inputData = $request->input('data');
        $id = $request->input('user_id');

        $data = Horse::where('user_id', $id)->where('place', 'stall')->get();
        return response()->json(['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function gotoStall(Request $request)
    {
        $inputData = $request->input('data');
        $stall_id = $inputData['stall_id'];
        $horse_id = $inputData['horse_id'];
        $user_id = $inputData['user_id'];

        Horse::where('id', $horse_id)->update([
            'stall_id' => $stall_id,
            'place' => 'stall',
        ]);

        $checkStall = StallSp::where('stall_id', $stall_id)->where('user_id', $user_id)->get();

        if ($checkStall->isEmpty()) {
            $newStall = new StallSp();
            $newStall->stall_id = $stall_id;
            $newStall->level = 1;
            $newStall->price = 1000;
            $newStall->user_id = $user_id;

            $newStall->save();
        }
        User::where('id', $user_id)->update([
            'user_pt' => \DB::raw('user_pt - 1000')
        ]);

        $user = User::where('id', $user_id)->get();
        $horses = Horse::where('user_id', $user_id)->where('stall_id', $stall_id)->get();
        return response()->json(['data' => $user, 'horses' => $horses]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * get random horse
     */
    public function randomShow($age, $id_key)
    {
        $growth_rand = ["早め", "普通", "晩成", "遅め", "早熟", "持続"];
        $ground_rand = ["芝", "ダ", "万"];
        $quality_leg_rand = ["自", "先", "逃", "追", "差", "大逃"];
        $gender_rand = ["牝", "牡"];
        $factor_2_rand = [60, 120, 30, 75];
        $factor_3_rand = [70, 100, 100, 150];


        $color = $this->setColor();
        $growth = $growth_rand[array_rand($growth_rand)];
        $ground = $ground_rand[array_rand($ground_rand)];
        $quality_leg = $quality_leg_rand[array_rand($quality_leg_rand)];
        $gender = $gender_rand[array_rand($gender_rand)];

        if ($age == "・0歳馬") {
            $per_mark = $this->setPattern($age);
            switch ($per_mark) {
                case 'D':
                    $factor_1_rand = [50, 135, 0, 50];
                    $price = 1000;
                    break;
                case 'C':
                    $factor_1_rand = [50, 135, 51, 100];
                    $price = rand(10, 40) * 100;
                    break;
                case 'B':
                    $factor_1_rand = [50, 135, 101, 150];
                    $price = rand(10, 60) * 100;
                    break;
                case 'A':
                    $factor_1_rand = [50, 135, 151, 200];
                    $price = rand(10, 80) * 100;
                    break;
                case 'S':
                    $factor_1_rand = [50, 135, 201, 250];
                    $price = rand(10, 100) * 100;
                    break;
            }
            $speed_b = rand($factor_1_rand[0], $factor_1_rand[1]);
            $strength_b = rand($factor_1_rand[0], $factor_1_rand[1]);
            $stamina_b = rand($factor_1_rand[0], $factor_1_rand[1]);
            $moment_b = rand($factor_1_rand[0], $factor_1_rand[1]);
            $condition_b = rand($factor_1_rand[0], $factor_1_rand[1]);
            $health_b = rand($factor_1_rand[0], $factor_1_rand[1]);
            $speed_w = rand($factor_1_rand[2], $factor_1_rand[3]);
            $strength_w = rand($factor_1_rand[2], $factor_1_rand[3]);
            $stamina_w = rand($factor_1_rand[2], $factor_1_rand[3]);
            $moment_w = rand($factor_1_rand[2], $factor_1_rand[3]);
            $condition_w = rand($factor_1_rand[2], $factor_1_rand[3]);
            $health_w = rand($factor_1_rand[2], $factor_1_rand[3]);
        } else if ($age == "・1歳馬") {
            $per_mark = $this->setPattern($age);
            switch ($per_mark) {
                case 'D':
                    $factor_1_rand = [60, 120, 0, 50];
                    $price = 2000;
                    break;
                case 'C':
                    $factor_1_rand = [60, 120, 51, 100];
                    $price = rand(20, 60) * 100;
                    break;
                case 'B':
                    $factor_1_rand = [60, 120, 101, 150];
                    $price = rand(20, 90) * 100;
                    break;
                case 'A':
                    $factor_1_rand = [60, 120, 151, 200];
                    $price = rand(20, 120) * 100;
                    break;
                case 'S':
                    $factor_1_rand = [60, 120, 201, 250];
                    $price = rand(20, 150) * 100;
                    break;
            }
            $speed_b = rand($factor_2_rand[0], $factor_2_rand[1]);
            $strength_b = rand($factor_2_rand[0], $factor_2_rand[1]);
            $stamina_b = rand($factor_2_rand[0], $factor_2_rand[1]);
            $moment_b = rand($factor_2_rand[0], $factor_2_rand[1]);
            $condition_b = rand($factor_2_rand[0], $factor_2_rand[1]);
            $health_b = rand($factor_2_rand[0], $factor_2_rand[1]);
            $speed_w = rand($factor_2_rand[2], $factor_2_rand[3]);
            $strength_w = rand($factor_2_rand[2], $factor_2_rand[3]);
            $stamina_w = rand($factor_2_rand[2], $factor_2_rand[3]);
            $moment_w = rand($factor_2_rand[2], $factor_2_rand[3]);
            $condition_w = rand($factor_2_rand[2], $factor_2_rand[3]);
            $health_w = rand($factor_2_rand[2], $factor_2_rand[3]);
            $price = 2000;
        } else {
            $per_mark = $this->setPattern($age);
            switch ($per_mark) {
                case 'D':
                    $factor_1_rand = [70, 100, 0, 50];
                    $price = 3000;
                    break;
                case 'C':
                    $factor_1_rand = [70, 100, 51, 100];
                    $price = rand(30, 80) * 100;
                    break;
                case 'B':
                    $factor_1_rand = [70, 100, 101, 150];
                    $price = rand(30, 120) * 100;
                    break;
                case 'A':
                    $factor_1_rand = [70, 100, 151, 200];
                    $price = rand(30, 160) * 100;
                    break;
                case 'S':
                    $factor_1_rand = [70, 100, 201, 250];
                    $price = rand(20, 200) * 100;
                    break;
            }
            $speed_b = rand($factor_3_rand[0], $factor_3_rand[1]);
            $strength_b = rand($factor_3_rand[0], $factor_3_rand[1]);
            $stamina_b = rand($factor_3_rand[0], $factor_3_rand[1]);
            $moment_b = rand($factor_3_rand[0], $factor_3_rand[1]);
            $condition_b = rand($factor_3_rand[0], $factor_3_rand[1]);
            $health_b = rand($factor_3_rand[0], $factor_3_rand[1]);
            $speed_w = rand($factor_3_rand[2], $factor_3_rand[3]);
            $strength_w = rand($factor_3_rand[2], $factor_3_rand[3]);
            $stamina_w = rand($factor_3_rand[2], $factor_3_rand[3]);
            $moment_w = rand($factor_3_rand[2], $factor_3_rand[3]);
            $condition_w = rand($factor_3_rand[2], $factor_3_rand[3]);
            $health_w = rand($factor_3_rand[2], $factor_3_rand[3]);
            $price = 3000;
        }

        $lineage = Lineage::inRandomOrder()->take(1)->get();
        foreach ($lineage as $key => $value) {
            $result = array(
                'id' => $id_key,
                'name' => $value['name'],
                'gender' => $gender,
                'age' => $age,
                'price' => $price,
                'color' => $color,
                'growth' => $growth,
                'ground' => $ground,
                'quality_leg' => $quality_leg,
                'speed_b' => $speed_b,
                'strength_b' => $strength_b,
                'stamina_b' => $stamina_b,
                'moment_b' => $moment_b,
                'condition_b' => $condition_b,
                'health_b' => $health_b,
                'speed_w' => $speed_w,
                'strength_w' => $strength_w,
                'stamina_w' => $stamina_w,
                'moment_w' => $moment_w,
                'condition_w' => $condition_w,
                'health_w' => $health_w,
                'distance_min' => $value['distance_min'],
                'distance_max' => $value['distance_max'],
                'hidden' => $value['hidden'],
                'triple_crown' => $value['triple_crown'],
                'f_sys' => $value['f_sys'],
                'f_name' => $value['f_name'],
                'f_factor' => $value['f_factor'],
                'm_sys' => $value['m_sys'],
                'm_name' => $value['m_name'],
                'f_f_sys' => $value['f_f_sys'],
                'f_f_name' => $value['f_f_name'],
                'f_f_factor' => $value['f_f_factor'],
                'f_m_sys' => $value['f_m_sys'],
                'f_m_name' => $value['f_m_name'],
                'm_f_sys' => $value['m_f_sys'],
                'm_f_name' => $value['m_f_name'],
                'm_f_factor' => $value['m_f_factor'],
                'm_m_sys' => $value['m_m_sys'],
                'm_m_name' => $value['m_m_name']
            );
        }
        return $result;
    }
    /**
     * set pattern
     */
    public function setPattern($age)
    {
        if ($age == "・0歳馬") {
            $options = [
                'D' => 76,
                'C' => 9,
                'B' => 7,
                'A' => 5,
                'S' => 3,
            ];
        } else if ($age == "・1歳馬") {
            $options = [
                'D' => 80,
                'C' => 8,
                'B' => 6,
                'A' => 4,
                'S' => 2,
            ];
        } else {
            $options = [
                'D' => 84,
                'C' => 7,
                'B' => 5,
                'A' => 3,
                'S' => 1,
            ];
        }

        $sel = rand(1, 100);

        foreach ($options as $option => $weight) {
            $sel -= $weight;
            // If the random number is less than or equal to zero, return the current option
            if ($sel <= 0) {
                return $option;
            }
        }
    }
    /**
     * This is the test not real.
     */
    public function getRandHorse(Request $request)
    {
        $age = $request->input('age');
        for ($i = 0; $i < 5; $i++) {
            $final_result['data'][$i] = $this->randomShow($age);
        }
        return $final_result;
    }
    /**
     * this is the interface to communicate with frontend directly.
     */
    public function requestRand()
    {
        for ($i = 0; $i < 20; $i++) {
            if ($i < 5) {
                $final_result['data'][$i] = $this->randomShow("・0歳馬", $i);
            } else if ($i >= 5 && $i < 10) {
                $final_result['data'][$i] = $this->randomShow("・1歳馬", $i);
            } else if ($i >= 10 && $i < 15) {
                $final_result['data'][$i] = $this->randomShow("・2歳馬", $i);
            } else {
                $final_result['data'][$i] = $this->randomShow("・繁殖馬", $i);
            }
        }
        return $final_result;
    }
    /**
     * Random set color
     */
    public function setColor()
    {
        $color_option = [
            '鹿毛' => 35,
            '黑鹿毛' => 30,
            '栗毛' => 20,
            '青鹿毛' => 5,
            '白毛' => 5,
        ];

        // setting color start
        $sel = rand(1, 95);

        foreach ($color_option as $option => $weight) {
            $sel -= $weight;
            // If the random number is less than or equal to zero, return the current option
            if ($sel <= 0) {
                return $option;
            }
        }
    }

    /////////////////////// let's start to develop a training page/////////////////////////////////
    // growing with training.
    public function grow(Request $request)
    {
        $inputData = $request->input('data');
        $horse_id = $inputData['horse_id'];
        $pt = $inputData['pt'];
        $what = $inputData['what'];
        $user_id = $inputData['user_id'];
        // $grow = $inputData['grow'];
        // $age = $inputData['age'];

        // check peak value
        // switch ($grow) {
        //     case '早熟':
        //         $speed_max = 50;
        //         $strength_max = 50;
        //         $stamina_max = 10;
        //         $moment_max = 50;
        //         $condition_max = 50;
        //         $health_max = 50;
        //         $age_max = 2;
        //         break;

        //     case '早め':
        //         $speed_max = 100;
        //         $strength_max = 100;
        //         $stamina_max = 10;
        //         $moment_max = 80;
        //         $condition_max = 100;
        //         $health_max = 99;
        //         $age_max = 3;
        //         break;

        //     case '普通':
        //         $speed_max = 150;
        //         $strength_max = 150;
        //         $stamina_max = 10;
        //         $moment_max = 80;
        //         $condition_max = 150;
        //         $health_max = 99;
        //         $age_max = 4;
        //         break;

        //     case '持続':
        //         $speed_max = 170;
        //         $strength_max = 170;
        //         $stamina_max = 10;
        //         $moment_max = 80;
        //         $condition_max = 170;
        //         $health_max = 99;
        //         $age_max = 4;
        //         break;

        //     case '遅め':
        //         $speed_max = 170;
        //         $strength_max = 200;
        //         $stamina_max = 10;
        //         $moment_max = 80;
        //         $condition_max = 185;
        //         $health_max = 99;
        //         $age_max = 5;
        //         break;

        //     case '晩成':
        //         $speed_max = 170;
        //         $strength_max = 170;
        //         $stamina_max = 10;
        //         $moment_max = 80;
        //         $condition_max = 170;
        //         $health_max = 99;
        //         $age_max = 6;
        //         break;

        //     default:
        //         $speed_max = 0;
        //         $strength_max = 0;
        //         $stamina_max = 0;
        //         $moment_max = 0;
        //         $condition_max = 0;
        //         $health_max = 0;
        //         $age_max = 0;
        //         break;
        // }

        // $out_factors = [];
        // if ($age == $age_max) {
        //     $grow_horse = GrowHorse::where('horse_id', $horse_id)->first();
        //     if ($grow_horse->speed_b == $speed_max) {
        //         array_push($out_factors, $speed_max);
        //         //$input_speed = 0;
        //     } elseif ($grow_horse->strength_b == $strength_max) {
        //         array_push($out_factors, $strength_max);
        //         //$input_strength = 0;
        //     } elseif ($grow_horse->stamina_b == $stamina_max) {
        //         array_push($out_factors, $stamina_max);
        //         //$input_stamina = 0;
        //     } elseif ($grow_horse->condition_b_b == $condition_max) {
        //         array_push($out_factors, $condition_max);
        //         //$input_stamina = 0;
        //     } elseif ($grow_horse->moment_b == $moment_max) {
        //         array_push($out_factors, $moment_max);
        //         //$input_moment = 0;
        //     } elseif ($grow_horse->health_b == $health_max) {
        //         array_push($out_factors, $health_max);
        //         //$input_health = 0;
        //     }
        //     if (!$out_factors) {
        //         return response()->json(['limit' => $out_factors]);
        //     }    
        // }

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
                Horse::where('id', $horse_id)->update([
                    'speed_b' => \DB::raw('speed_b + ' . $element_1),
                    'happy' => \DB::raw('happy + ' . $element_2),
                    'tired' => \DB::raw('tired + ' . $element_3),
                    'direction' => $cal_direction
                ]);
                // ///
                // GrowHorse::where('id', $horse_id)->update([
                //     'speed_b' => \DB::raw('speed_b + ' . $element_1)
                // ]);

            } else if ($what == "ダート") {
                Horse::where('id', $horse_id)->update([
                    'strength_b' => \DB::raw('strength_b + ' . $element_1),
                    'happy' => \DB::raw('happy + ' . $element_2),
                    'tired' => \DB::raw('tired + ' . $element_3),
                    'direction' => $cal_direction
                ]);
                ///
                // GrowHorse::where('id', $horse_id)->update([
                //     'strength_b' => \DB::raw('strength_b + ' . $element_1)
                // ]);
            } else {
                Horse::where('id', $horse_id)->update([
                    'condition_b' => \DB::raw('condition_b + ' . $element_1),
                    'happy' => \DB::raw('happy + ' . $element_2),
                    'tired' => \DB::raw('tired + ' . $element_3),
                    'direction' => $cal_direction
                ]);
                ///
                // GrowHorse::where('id', $horse_id)->update([
                //     'condition_b' => \DB::raw('condition_b + ' . $element_1)
                // ]);
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
                Horse::where('id', $horse_id)->update([
                    'stamina_b' => \DB::raw('stamina_b + ' . $element_1),
                    'happy' => \DB::raw('happy + ' . $element_2),
                    'tired' => \DB::raw('tired + ' . $element_3),
                    'direction' => $cal_direction
                ]);

                ///
                // GrowHorse::where('id', $horse_id)->update([
                //     'stamina_b' => \DB::raw('stamina_b + ' . $element_1)
                // ]);

            } else if ($what == "坂路") {
                Horse::where('id', $horse_id)->update([
                    'moment_b' => \DB::raw('moment_b + ' . $element_1),
                    'happy' => \DB::raw('happy + ' . $element_2),
                    'tired' => \DB::raw('tired + ' . $element_3),
                    'direction' => $cal_direction
                ]);

                ///
                // GrowHorse::where('id', $horse_id)->update([
                //     'moment_b' => \DB::raw('moment_b + ' . $element_1)
                // ]);

            } else {
                Horse::where('id', $horse_id)->update([
                    'health_b' => \DB::raw('health_b + ' . $element_1),
                    'happy' => \DB::raw('happy + ' . $element_2),
                    'tired' => \DB::raw('tired + ' . $element_3),
                    'direction' => $cal_direction
                ]);

                ///
                // GrowHorse::where('id', $horse_id)->update([
                //     'health_b' => \DB::raw('health_b + ' . $element_1)
                // ]);
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

            Horse::where('id', $horse_id)->update([
                'speed_b' => \DB::raw('speed_b + 5'),
                'strength_b' => \DB::raw('strength_b + 5'),
                'stamina_b' => \DB::raw('stamina_b + 5'),
                'moment_b' => \DB::raw('moment_b + 5'),
                'happy' => \DB::raw('happy + ' . $element_2),
                'tired' => \DB::raw('tired + ' . $element_3),
                'direction' => $cal_direction
            ]);

            ///
            // GrowHorse::where('id', $horse_id)->update([
            //     'speed_b' => \DB::raw('speed_b + 5'),
            //     'strength_b' => \DB::raw('strength_b + 5'),
            //     'stamina_b' => \DB::raw('stamina_b + 5'),
            //     'moment_b' => \DB::raw('moment_b + 5')
            // ]);
        }

        Horse::where('id', $horse_id)->update(['etc' => 1]);
        User::where('id', $user_id)->update(['user_pt' => \DB::raw('user_pt -' . $pt)]);
        $send_horse = Horse::where('user_id', $user_id)->get();
        $user = User::where('id', $user_id)->get();
        return response()->json(['data' => $user, 'horse' => $send_horse]);
    }
    // growing with eat.
    public function improve(Request $request)
    {
        $inputData = $request->input('data');
        if (!isset($inputData['horse_id']) || !isset($inputData['pt']) || !isset($inputData['what']) || !isset($inputData['user_id'])) {
            return response()->json(['message' => 'missing fields'], 422);
        }
        $horse_id = $inputData['horse_id'];
        $pt = $inputData['pt'];
        $what = $inputData['what'];
        $user_id = $inputData['user_id'];

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

        $user = User::where('id', $user_id)->get();
        $send_horse = Horse::where('user_id', $user_id)->get();
        return response()->json(['data' => $user, 'horse' => $send_horse]);
    }
    // goto stall from pasture

}