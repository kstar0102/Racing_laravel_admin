<?php

namespace App\Http\Controllers;

use App\Models\Jockey;
use App\Models\RacePlan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\RaceRegister;
use App\Models\PrizeMoney;

class RaceRegisterController extends Controller
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
        $race_id = $inputData['race_id'];
        $user_name = $inputData['user_name'];
        $user_id = $inputData['user_id'];
        $horse_id = $inputData['horse_id'];
        $horse_name = $inputData['horse_name'];
        $horse_gender = $inputData['horse_gender'];
        $horse_age = $inputData['horse_age'];
        $mass = $inputData['mass'];
        $stall_type = $inputData['stall_type'];
        $jockey_id = $inputData['jockey_id'];
        $jockey_name = $inputData['jockey_name'];
        $quality_leg = $inputData['quality_leg'];
        $prize_id = $inputData['race_type'];
        $last_play = $inputData['last_play'];
        $week = $inputData['week'];
        $price = $inputData['price'];

        $count = RaceRegister::where('race_id', $race_id)->count();
        $count_user = RaceRegister::where('race_id', $race_id)->where('user_id', $user_id)->count();

        $check_race_horse = RaceRegister::where('race_id', $race_id)->where('user_id', $user_id)->where('horse_id', $horse_id);

        if ($check_race_horse->count() > 0) {
            return response()->json(['message' => 'すでに登録されている馬です。']);
        }

        $check_race_jockey = RaceRegister::where('race_id', $race_id)->where('user_id', $user_id)->where('jockey_id', $jockey_id);

        if ($check_race_jockey->count() > 0) {
            return response()->json(['message' => 'すでに登録されている騎手です。']);
        }

        if ($count < 10 && $count_user < 5) {
            $model = new RaceRegister();
            $model->race_id = $race_id;
            $model->user_name = $user_name;
            $model->user_id = $user_id;
            $model->horse_id = $horse_id;
            $model->horse_name = $horse_name;
            $model->horse_gender = $horse_gender;
            $model->horse_age = $horse_age;
            $model->mass = $mass;
            $model->jockey_id = $jockey_id;
            $model->jockey_name = $jockey_name;
            $model->quality_leg = $quality_leg;
            $model->stall_type = $stall_type;
            $model->prize_id = $prize_id;
            $model->last_play = $last_play;
            $model->week = $week;
            $model->etc = $price;
            $model->save();

            User::where('id', $user_id)->update([
                'user_pt' => \DB::raw('user_pt - ' . $price)
            ]);

            $user = User::where('id', $user_id)->get();
            $race_register_data = RaceRegister::where('race_id', $race_id)->get();
            return response()->json(['user' => $user, 'race_register_data' => $race_register_data]);
        } else {
            return response()->json(['message' => 'failed']);
        }
    }


    public function backRegister(Request $request)
    {
        $inputData = $request->input('data');
        $race_id = $inputData['race_id'];

        $data = RaceRegister::where('race_id', $race_id)->firstOrFail();

        RaceRegister::where('race_id', $race_id)->delete();

        $race_register_data = RaceRegister::where('race_id', $race_id)->get();


        return response()->json(['race_register_data' => $race_register_data]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $inputData = $request->input('data');
        if (isset($inputData['race_id'])) {
            $race_id = $inputData['race_id'];

            $race_data = RacePlan::where('id', $race_id)->first();
            $race_register_data = RaceRegister::where('race_id', $race_id)->get();
            $jockeys = Jockey::get();
            if ($race_data) {
                $race_type = $race_data->type;
                $prize_data = PrizeMoney::where('race_type', $race_type)->get();
                return response()->json(['race_data' => $race_data, 'race_register_data' => $race_register_data, 'prize_data' => $prize_data, 'jockeys' => $jockeys]);
            } else {
                // Handle the case where race_data does not exist
                return response()->json(['error' => 'Race data does not exist']);
            }
        } else {
            // Handle the case where race_id is missing from the input data
            return response()->json(['error' => 'Race ID is missing']);
        }

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

    public function getRegisterValue(Request $request)
{
    $inputData = $request->input('data');
    if (!is_array($inputData)) {
        return response()->json(['message' => 'Invalid input data']);
    }

    $user_id = isset($inputData['user_id']) ? $inputData['user_id'] : null;
    $next_week = isset($inputData['next_week']) ? $inputData['next_week'] : null;

    if (!$user_id || !$next_week) {
        return response()->json(['message' => 'Missing required parameters']);
    }

    $result = RaceRegister::where('user_id', $user_id)->where('week', $next_week)->get();
    
    return response()->json(['data' => $result]);
}

public function registerState(Request $request)
{
    // Step 1: Input validation
    $inputData = $request->validate([
        'data.next_week' => 'required',
        'data.user_id' => 'required',
        'data.next_next_week' => 'required',
        'data.next_next_next_week' => 'required'
    ]);

    $nextWeek = $inputData['data']['next_week'];
    $userId = $inputData['data']['user_id'];
    $nextNextWeek = $inputData['data']['next_next_week'];
    $nextNextNextWeek = $inputData['data']['next_next_next_week'];

    // Step 2: Query execution and error handling
    try {
        $result = RaceRegister::whereIn('week', [$nextWeek, $nextNextWeek, $nextNextNextWeek])
            ->where('user_id', $userId)
            ->get();

        // Step 3: Response format
        return response()->json([
            'status' => 'success',
            'data' => $result,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
        ]);
    }
}


}