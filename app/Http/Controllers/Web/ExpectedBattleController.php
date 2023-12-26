<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RaceManagement;
use App\Models\ExpectedBattle;
use Carbon\Carbon;

class ExpectedBattleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $expected_race_data = RaceManagement::where('race_state', 0)->with('places')->with('running_horses')->with('web_race_results')->with('delete_horses')->get();

        $new_expected_race_data = array();
        foreach ($expected_race_data as $key => $value) {
            $datetimeString = $value->event_date . ' ' . $value->hour_data . ':' . $value->minute_data;

            $givenDateTime = Carbon::parse($datetimeString);
            $adjustedGivenDateTime = $givenDateTime->subMinutes(2); // Subtract 2 minutes from the given time
            $currentDateTime = Carbon::now();

            if ($adjustedGivenDateTime->gt($currentDateTime)) {
                array_push($new_expected_race_data, $value);
            }
        }
        
        return response()->json(['expected_race_data' => $new_expected_race_data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user_id = $request->user_id;
        $expected_battle_data = $request->expected_battle_data;
        $race_management_id = $request->race_management_id;

        $getExpected = ExpectedBattle::where('user_id', $user_id)->where('race_management_id',$race_management_id)->get();

        if (count($getExpected)) {
            # code...
            ExpectedBattle::where('user_id', $user_id)->where('race_management_id', $race_management_id)
                ->update([
                    'double_circle' => $expected_battle_data[0], 
                    'single_circle' => $expected_battle_data[1],
                    'triangle' => $expected_battle_data[2],
                    'five_star' => $expected_battle_data[3],
                    'hole' => $expected_battle_data[4],
                    'disappear' => $expected_battle_data[5],
                ]);
        }else{
            $expected_battle = new ExpectedBattle();
            $expected_battle->double_circle = $expected_battle_data[0];
            $expected_battle->single_circle = $expected_battle_data[1];
            $expected_battle->triangle = $expected_battle_data[2];
            $expected_battle->five_star = $expected_battle_data[3];
            $expected_battle->hole = $expected_battle_data[4];
            $expected_battle->disappear = $expected_battle_data[5];
            $expected_battle->user_id = $user_id;
            $expected_battle->race_management_id = $race_management_id;
            $expected_battle->save();
        }


        $expected_battle_data = ExpectedBattle::where('user_id', $user_id)->get();
        return response()->json(['expected_battle_data' => $expected_battle_data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $expected_battle_data = ExpectedBattle::where('user_id', $id)->get();
        return response()->json(['expected_battle_data' => $expected_battle_data]);
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
}
