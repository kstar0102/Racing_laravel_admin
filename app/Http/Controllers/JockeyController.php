<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jockey;
use App\Models\User;

class JockeyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $user_id = $inputData['user_id'];

        $model = new Jockey();
        $model->name = $inputData['name'];
        $model->gender = $inputData['gender'];
        $model->user_id = $user_id;
        $model->age = 20;
        $model->prize = 0;
        $model->happy = 10;
        $model->tired = 0;
        $model->level = 0;
        $model->t1 = 0;
        $model->t2 = 0;
        $model->t3 = 0;
        $model->t4 = 0;
        $model->p_miss = 1;
        $model->p_target = 1;
        $model->p_difference = 1;
        $model->p_add = 1;
        $model->direction = 1;
        $model->special = '';
        $model->save();

        User::where('id', $user_id)->update(['user_pt' => \DB::raw('user_pt - 5000')]);
        $user = User::where('id', $user_id)->get();
        $jockey = Jockey::where('user_id', $user_id)->get();
        return response()->json(['user' => $user, 'jockey' => $jockey]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user_id = $request->input('data');

        $jockey = Jockey::where('user_id', $user_id)->get();

        return response()->json(['data' => $jockey]);
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
    public function update(Request $request, $id)
    {
        //
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

    public function grow(Request $request)
    {
        $inputData = $request->input('data');
        $jockey_id = $inputData['jockey_id'];
        $pt = $inputData['pt'];
        $what = $inputData['what'];
        $user_id = $inputData['user_id'];

        // get cal happy and tired values
        $happy_value = Jockey::select('happy')->where('id', $jockey_id)->first();
        $tired_value = Jockey::select('tired')->where('id', $jockey_id)->first();
        $direction_value = Jockey::select('direction')->where('id', $jockey_id)->first();

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

        if ($what == "逃げ" || $what == "先行" || $what == "差し" || $what == "追い") {
            if ($pt == "2") {
                $element_1 = 1;
                $element_3 = 1;
            } else if ($pt == "4") {
                $element_1 = 2;
                $element_3 = 2;
            } else {
                $element_1 = 3;
                $element_3 = 3;
            }
            if ($cal_tired >= 20) {
                $element_3 = 20 - $cal_tired;
            }

            if ($what == "逃げ") {
                Jockey::where('id', $jockey_id)->update([
                    'p_miss' => \DB::raw('p_miss + ' . $element_1),
                    'happy' => \DB::raw('happy + ' . $element_2),
                    'tired' => \DB::raw('tired + ' . $element_3),
                    'direction' => $cal_direction
                ]);

            } else if ($what == "先行") {
                Jockey::where('id', $jockey_id)->update([
                    'p_target' => \DB::raw('p_target + ' . $element_1),
                    'happy' => \DB::raw('happy + ' . $element_2),
                    'tired' => \DB::raw('tired + ' . $element_3),
                    'direction' => $cal_direction
                ]);
            } else if ($what == "差し") {
                Jockey::where('id', $jockey_id)->update([
                    'p_difference' => \DB::raw('p_difference + ' . $element_1),
                    'happy' => \DB::raw('happy + ' . $element_2),
                    'tired' => \DB::raw('tired + ' . $element_3),
                    'direction' => $cal_direction
                ]);
            } else if ($what == "追い") {
                Jockey::where('id', $jockey_id)->update([
                    'p_add' => \DB::raw('p_add + ' . $element_1),
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

            Jockey::where('id', $jockey_id)->update([
                'p_miss' => \DB::raw('p_miss + 5'),
                'p_difference' => \DB::raw('p_difference + 5'),
                'p_target' => \DB::raw('p_target + 5'),
                'p_add' => \DB::raw('p_add + 5'),
                'happy' => \DB::raw('happy + ' . $element_2),
                'tired' => \DB::raw('tired - ' . $element_3),
                'direction' => $cal_direction
            ]);
        }

        Jockey::where('id', $jockey_id)->update(['etc' => 1]);
        User::where('id', $user_id)->update(['user_pt' => \DB::raw('user_pt -' . $pt)]);
        $send_jockey = Jockey::where('user_id', $user_id)->get();
        $user = User::where('id', $user_id)->get();
        return response()->json(['data' => $user, 'jockey' => $send_jockey]);
    }

    public function improve(Request $request)
    {
        $inputData = $request->input('data');
        if (!isset($inputData['jockey_id']) || !isset($inputData['pt']) || !isset($inputData['what']) || !isset($inputData['user_id'])) {
            return response()->json(['message' => 'missing fields'], 422);
        }
        $jockey_id = $inputData['jockey_id'];
        $pt = $inputData['pt'];
        $what = $inputData['what'];
        $user_id = $inputData['user_id'];

        $happy_value = Jockey::select('happy')->where('id', $jockey_id)->first();
        $tired_value = Jockey::select('tired')->where('id', $jockey_id)->first();
        $direction_value = Jockey::select('direction')->where('id', $jockey_id)->first();

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
            Jockey::where('id', $jockey_id)->update([
                'happy' => \DB::raw('happy + ' . $element),
                'direction' => $cal_direction
            ]);
        } else if ($pt == 2 || $pt == 4 || $pt == 6) {
            $check_tired = Jockey::select('tired')->where('id', $jockey_id)->first();
            if ($check_tired->tired < 0) {
                $element = 0;
            }
            Jockey::where('id', $jockey_id)->update([
                'tired' => \DB::raw('tired + ' . $element),
                'direction' => $cal_direction
            ]);
        }

        // Refactored update statement
        User::where('id', $user_id)->update([
            'user_pt' => \DB::raw('user_pt - ' . $pt)
        ]);

        $user = User::where('id', $user_id)->get();
        $send_jockey = Jockey::where('user_id', $user_id)->get();
        return response()->json(['data' => $user, 'jockey' => $send_jockey]);
    }

    public function nameCheck(Request $request)
    {
        $inputData = $request->input('data');

        // Validate input data before accessing its values.
        if (!is_array($inputData) || !isset($inputData['jockey_name'])) {
            return response()->json(['message' => 'Invalid input data']);
        }

        $name = $inputData['jockey_name'];

        $jockey = Jockey::where('name', $name)->get();
        if ($jockey->isEmpty()) {
            return response()->json(['message' => 'success', 'name' => $inputData['jockey_name']]);
        } else {
            return response()->json(['message' => '現在登録されている名前です。', 'name' => ' ']);
        }
    }

}