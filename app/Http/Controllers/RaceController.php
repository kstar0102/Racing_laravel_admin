<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jockey;
use App\Models\Horse;
use App\Models\RacePlan;
use App\Models\RaceResult;
use App\Models\User;

use Symfony\Component\Console\Input\InputDefinition;

class RaceController extends Controller
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
        //
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
        $horse_id = $inputData['horse_id'];
        $jockey_id = $inputData['jockey_id'];

        $horses = [];
        $jockeys = [];
        for ($i = 0; $i < count($horse_id); $i++) {
            $insertHorse = Horse::where('id', $horse_id[$i])->get();
            array_push($horses, $insertHorse);
            $insertJockey = Jockey::where('id', $jockey_id[$i])->get();
            array_push($jockeys, $insertJockey);
        }

        return response()->json(['horse_data' => $horses, 'jockey_data' => $jockeys]);
    }

    public function race_result(Request $request)
    {
        $getData = $request->input('data');
        $inputData = $getData['data'];
        $this_month_week = $getData['this_month_week'];
        
         $month_week = RacePlan::where('id', $inputData[0]['race_id'])->first();
         $check_repeat = RaceResult::where('race_id', $inputData[0]['race_id'])->first();
         
         \Log::info($this_month_week);
        if($month_week->weeks == $this_month_week && !$check_repeat)
        {
            for ($i = 0; $i < count($inputData); $i++) {

                $race_id = $inputData[$i]['race_id'];
                $user_name = $inputData[$i]['user_name'];
                $user_id = $inputData[$i]['user_id'];
                $horse_name = $inputData[$i]['horse_name'];
                $horse_id = $inputData[$i]['horse_id'];
                $horse_gender = $inputData[$i]['horse_gender'];
                $horse_age = $inputData[$i]['horse_age'];
                $mass = $inputData[$i]['mass'];
                $jockey_name = $inputData[$i]['jockey_name'];
                $jockey_id = $inputData[$i]['jockey_id'];
                $quality_leg = $inputData[$i]['quality_leg'];
                $race_type = $inputData[$i]['race_type'];
                $stall_type = $inputData[$i]['stall_type'];
                $prize = $inputData[$i]['prize'];
                $time = $inputData[$i]['time'];
                $ranking = $inputData[$i]['ranking'];
                $etc = $inputData[$i]['year'];
                $week = $this_month_week;

                User::where('id', $user_id)->update(['user_pt' => \DB::raw('user_pt +' . $prize)]);

                // change horse status
                $tired = 0;
                $happy = 0;
                switch($race_type)
                {
                    case '新馬' :
                        $tired = 3;
                        $happy = -3;
                    case '未勝利' :
                        $tired = 1;
                        $happy = -1;
                    case '1勝クラス' :
                        $tired = 2;
                        $happy = -2;
                    case '2勝クラス' :
                        $tired = 3;
                        $happy = -3;
                    case '3勝クラス' :
                        $tired = 4;
                        $happy = -4;
                    case 'OPEN' :
                        $tired = 5;
                        $happy = -5;
                    case 'GIII' :
                        $tired = 6;
                        $happy = -6;
                    case 'GII' :
                        $tired = 7;
                        $happy = -7;
                    case 'GI' :
                        $tired = 8;
                        $happy = -8;
                    case '海外GI' :
                        $tired = 9;
                        $happy = -9;
                    case '海外GI' :
                        $tired = 10;
                        $happy = -10;
                }

                Horse::where('id', $horse_id)->update([
                    'tired' => \DB::raw('tired +' . $tired),
                    'happy' => \DB::raw('happy +' . $happy)
                ]);

                $model = new RaceResult();
                $model->race_id = $race_id;
                $model->user_name = $user_name;
                $model->user_id = $user_id;
                $model->horse_name = $horse_name;
                $model->horse_id = $horse_id;
                $model->horse_gender = $horse_gender;
                $model->horse_age = $horse_age;
                $model->mass = $mass;
                $model->jockey_name = $jockey_name;
                $model->jockey_id = $jockey_id;
                $model->quality_leg = $quality_leg;
                $model->race_type = $race_type;
                $model->stall_type = $stall_type;
                $model->prize = $prize;
                $model->time = $time;
                $model->last_play = $week;
                $model->ranking = $ranking;
                $model->etc = $etc;
    
                $model->save();              
            }

            $user = User::where('id', $user_id)->get();
            return response()->json(['user' => $user]);
        }
        else
        {
            return response()->json(['message' => 'success']);
        }

        return response()->json(['message' => $inputData[1]]);
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

    public function get_race_result(Request $request)
    {
        $inputData = $request->input('data');
        $week = $inputData['week'];
        $type = $inputData['type'];

        $result = RaceResult::where('last_play', $week)->where('race_type', $type)->get();
        return response()->json(['data' => $result]);        
    }
}
