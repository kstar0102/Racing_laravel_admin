<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Places;
use App\Models\RaceManagement;
use App\Models\RunningHorse;
use App\Models\WebRaceResult;
use App\Models\DeleteHorse;
use App\Models\ExpectedBattle;
use App\Models\PlayerRanking;
use App\Models\User;

class RaceManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $response_data = RaceManagement::with('places')
            ->with('running_horses')->with('web_race_results')
            ->with('delete_horses')->orderByDesc('event_date')->get();
        return response()->json(['races_data' => $response_data]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request) {
        $race_management = new RaceManagement();
        $race_management->event_date = $request->event_date;
        $race_management->event_place = $request->event_place;
        $race_management->race_number = $request->race_number;
        $race_management->hour_data = $request->hour_data;
        $race_management->minute_data = $request->minute_data;
        $race_management->race_name = $request->race_name;
        $race_management->month_data = $request->month_data;
        $race_management->save();
       
        $horse_data = $request->horse_data;
        
        foreach ($horse_data as $key => $value) {
            # code...
            $running_horse = new RunningHorse();
            $running_horse->name = ($key+1).':'.$value;
            $running_horse->race_management_id = $race_management->id;
            $running_horse->save();
        }

        $response_data = RaceManagement::with('places')->with('running_horses')->with('web_race_results')->with('delete_horses')->get();
        return response()->json(['races_data' => $response_data]);
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
        // $response_data = RaceManagement::where('event_date', $id)->with('places')->with('running_horses')->with('web_race_results')->with('delete_horses')->get();
        // return response()->json(['races_data' => $response_data]);
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
        $race_management = RaceManagement::find($id);
        $race_management->event_date = $request->event_date;
        $race_management->event_place = $request->event_place;
        $race_management->race_number = $request->race_number;
        $race_management->hour_data = $request->hour_data;
        $race_management->minute_data = $request->minute_data;
        $race_management->race_name = $request->race_name;
        $race_management->month_data = $request->month_data;
        $race_management->save();
       
        $horse_data = $request->horse_data;
        $first_running_horse =  RunningHorse::where('race_management_id', $id)->first();
        $horse_id = $first_running_horse->id;
        foreach ($horse_data as $key => $value) {
            $running_horse = RunningHorse::where('id', $horse_id)->exists();
            if ($running_horse) {
                RunningHorse::find($horse_id)->update([
                    'name' => ($key+1).':'.$value, 
                    'race_management_id' => $race_management->id,
                ]);
            }else{
                $new_running_horse = new RunningHorse();
                $new_running_horse->name = ($key+1).':'.$value;
                $new_running_horse->race_management_id = $race_management->id;
                $new_running_horse->save();
            }
            
            $horse_id++;
        }

        $response_data = RaceManagement::with('places')->with('running_horses')->with('web_race_results')->with('delete_horses')->get();
        return response()->json(['races_data' => $response_data]);
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
        RaceManagement::find($id)->delete();
        $response_data = RaceManagement::with('places')->with('running_horses')->with('web_race_results')->with('delete_horses')->get();
        return response()->json(['races_data' => $response_data]);
    }

    public function get_places() {
        $data = Places::select('id', 'name')->get();

        return response()->json(['places_data' => $data]);
    }

    public function create_race_result(Request $request){
        $id = $request->id;
        $race_result = $request->race_result;
        $delete_horses_data = $request->delete_horses_data;

        $web_race_result_data = WebRaceResult::where('race_management_id', $id)->get();

        if (!count($web_race_result_data)) {
            # code...
            foreach ($race_result as $key => $value) {
                # code...      'rank' => '1着',
                $web_race_result = new WebRaceResult();
                $web_race_result->rank = $value['rank'];
                $web_race_result->horse = $value['horse'];
                $web_race_result->odds = $value['odds'];
                $web_race_result->single = $value['single'] ? $value['single'] : '';
                $web_race_result->double = $value['double'] ? $value['double'] : '';
                $web_race_result->race_management_id = $id;
                $web_race_result->save();
            }
        }else{
            WebRaceResult::where('race_management_id', $id)->delete();
            
            foreach ($race_result as $key => $value) {
                # code...      'rank' => '1着',
                $web_race_result = new WebRaceResult();
                $web_race_result->rank = $value['rank'];
                $web_race_result->horse = $value['horse'];
                $web_race_result->odds = $value['odds'];
                $web_race_result->single = $value['single'] ? $value['single'] : '';
                $web_race_result->double = $value['double'] ? $value['double'] : '';
                $web_race_result->race_management_id = $id;
                $web_race_result->save();
            }
        }

        # Score calculation logic Begin #
        $getExpectedBattle = ExpectedBattle::where('race_management_id', $id)->get();
  
        if (count($getExpectedBattle)) {

            foreach ($getExpectedBattle as $key => $value) {

                # Individual player score calculation logic Begin #

                $first_race_result = [];
                $second_race_result = [];
                $three_race_restult = [];

                foreach ($race_result as $key => $data) {
                    if ($data['rank'] == '1着') {
                        array_push($first_race_result, $data['horse']);
                    }else if ($data['rank'] == '2着') {
                        array_push($second_race_result, $data['horse']);
                    }elseif ($data['rank'] == '3着') {
                        array_push($three_race_restult, $data['horse']);
                    }
                }

                $single_win_odd_award = 0;
                $prize_horse_award_array = [$first_race_result, $second_race_result, $three_race_restult];
                $mainArray = [$value->double_circle, $value->single_circle, $value->triangle, $value->five_star, $value->hole];
                foreach ($prize_horse_award_array[0] as $key => $data) {
                    if (in_array($data, $mainArray)) {
                        $single_win_odd_award += $race_result[0]['odds'];
                    }
                }
                foreach ($prize_horse_award_array[1] as $key => $data) {
                    if (in_array($data, $mainArray)) {
                        $single_win_odd_award += $race_result[1]['odds'];
                    }
                }
                foreach ($prize_horse_award_array[2] as $key => $data) {
                    if (in_array($data, $mainArray)) {
                        $single_win_odd_award += $race_result[2]['odds'];
                    }
                }
                \Log::info("single_win_odd_award");
                \Log::info($single_win_odd_award);
                \Log::info("single_win_odd_award");
                
                $single_win_award_bonus = 0;
                if (in_array($mainArray[0], $first_race_result)) {
                    $single_win_award_bonus += 200;
                }
                \Log::info($single_win_award_bonus);

                $double_win_award_bonus = 0;
                $double_win_bonus = 0;
                $double_win_award_array = [];
                foreach ($first_race_result as $key => $item) {
                    array_push($double_win_award_array, $item);
                }
                foreach ($second_race_result as $key => $item) {
                    array_push($double_win_award_array, $item);
                }
                foreach ($three_race_restult as $key => $item) {
                    array_push($double_win_award_array, $item);
                }
                if (in_array($mainArray[0], $double_win_award_array)) {
                    $double_win_award_bonus += 100;
                    $double_win_bonus++;
                }
                \Log::info($double_win_award_bonus);

                $horse_racing_award_bonus = 0;
                $horse_racing_win = 0;
                $horse_racing_award_array = [];
                foreach ($first_race_result as $key => $item) {
                    array_push($horse_racing_award_array, $item);
                }
                foreach ($second_race_result as $key => $item) {
                    array_push($horse_racing_award_array, $item);
                }

                if (in_array($mainArray[0], $horse_racing_award_array) && in_array($mainArray[1], $horse_racing_award_array)) {
                    $horse_racing_award_bonus += 200;
                    $horse_racing_win++;
                }
                if (in_array($mainArray[0], $horse_racing_award_array) && in_array($mainArray[2], $horse_racing_award_array)) {
                    $horse_racing_award_bonus += 150;
                    $horse_racing_win++;
                }
                if (in_array($mainArray[0], $horse_racing_award_array) && in_array($mainArray[3], $horse_racing_award_array)) {
                    $horse_racing_award_bonus += 100;
                    $horse_racing_win++;
                }
                if (in_array($mainArray[0], $horse_racing_award_array) && in_array($mainArray[4], $horse_racing_award_array)) {
                    $horse_racing_award_bonus += 50;
                    $horse_racing_win++;
                }
                \Log::info($horse_racing_award_bonus);

                $triplicate_award_bonus = 0;
                $triplicate_win = 0;
                if (in_array($mainArray[0], $double_win_award_array) && in_array($mainArray[1], $double_win_award_array) && in_array($mainArray[2], $double_win_award_array)) {
                    $triplicate_award_bonus += 500;
                    $triplicate_win++;
                }
                if (in_array($mainArray[0], $double_win_award_array) && in_array($mainArray[1], $double_win_award_array) && in_array($mainArray[3], $double_win_award_array)) {
                    $triplicate_award_bonus += 450;
                    $triplicate_win++;
                }
                if (in_array($mainArray[0], $double_win_award_array) && in_array($mainArray[1], $double_win_award_array) && in_array($mainArray[4], $double_win_award_array)) {
                    $triplicate_award_bonus += 400;
                    $triplicate_win++;
                }
                if (in_array($mainArray[0], $double_win_award_array) && in_array($mainArray[2], $double_win_award_array) && in_array($mainArray[3], $double_win_award_array)) {
                    $triplicate_award_bonus += 350;
                    $triplicate_win++;
                }
                if (in_array($mainArray[0], $double_win_award_array) && in_array($mainArray[2], $double_win_award_array) && in_array($mainArray[4], $double_win_award_array)) {
                    $triplicate_award_bonus += 300;
                    $triplicate_win++;
                }
                if (in_array($mainArray[0], $double_win_award_array) && in_array($mainArray[3], $double_win_award_array) && in_array($mainArray[4], $double_win_award_array)) {
                    $triplicate_award_bonus += 250;
                    $triplicate_win++;
                }
                if (in_array($mainArray[1], $double_win_award_array) && in_array($mainArray[2], $double_win_award_array) && in_array($mainArray[3], $double_win_award_array)) {
                    $triplicate_award_bonus += 200;
                    $triplicate_win++;
                }
                if (in_array($mainArray[1], $double_win_award_array) && in_array($mainArray[2], $double_win_award_array) && in_array($mainArray[4], $double_win_award_array)) {
                    $triplicate_award_bonus += 150;
                    $triplicate_win++;
                }
                if (in_array($mainArray[1], $double_win_award_array) && in_array($mainArray[3], $double_win_award_array) && in_array($mainArray[4], $double_win_award_array)) {
                    $triplicate_award_bonus += 100;
                    $triplicate_win++;
                }
                if (in_array($mainArray[2], $double_win_award_array) && in_array($mainArray[3], $double_win_award_array) && in_array($mainArray[4], $double_win_award_array)) {
                    $triplicate_award_bonus += 50;
                    $triplicate_win++;
                }
                \Log::info($triplicate_award_bonus);

                $delete_horse_award_bonus = 0;
                if (!in_array($value->disappear, $double_win_award_array)) {
                    \Log::info("*****************************");
                    \Log::info($value->disappear);
                    \Log::info($delete_horses_data);
                    \Log::info("*****************************");
                    if ($value->disappear == $delete_horses_data[0]) {
                        $delete_horse_award_bonus += 50;
                    }elseif ($value->disappear == $delete_horses_data[1]) {
                        $delete_horse_award_bonus += 40;
                    }elseif ($value->disappear == $delete_horses_data[2]) {
                        $delete_horse_award_bonus += 30;
                    }elseif ($value->disappear == $delete_horses_data[3]) {
                        $delete_horse_award_bonus += 20;
                    }elseif ($value->disappear == $delete_horses_data[4]) {
                        $delete_horse_award_bonus += 10;
                    }

                }
                \Log::info("============================");
                \Log::info($delete_horse_award_bonus);
                \Log::info("============================");

                $total_award_bonus = $single_win_odd_award + $single_win_award_bonus + $double_win_award_bonus + $horse_racing_award_bonus + $triplicate_award_bonus + $delete_horse_award_bonus;

                $purchase_money = 100;

                $single_win_probability = 0;
                $single_win = 0;

                foreach ($race_result as $key => $data) {
                    if ($data['rank'] == '1着') {
                        if ($data['horse'] == $mainArray[0]) {
                            $single_win_probability += $data['single'] * $purchase_money / 100;
                            $single_win++;
                        }
                    }
                }
                \Log::info($single_win_probability);

                $double_win_probability = 0;
                $double_win = 0;
                foreach ($race_result as $key => $data) {
                    if (in_array($data['horse'], $mainArray)) {
                        $double_win_probability += $data['double'] * $purchase_money / 100;
                        $double_win++;
                    }
                }
                \Log::info($double_win_probability);

                # Individual player score calculation logic End #
                $getPlayerRanking = PlayerRanking::where('user_id', $value->user_id)->where('race_management_id',$id)->get();

                if (count($getPlayerRanking)) {
                    $oldPlayerRanking = PlayerRanking::where('user_id', $value->user_id)->where('race_management_id', $id)->first();
                    $oldUser = User::find($value->user_id);

                    User::where('id', $value->user_id)->update([
                        'user_pt' => ($oldUser->user_pt - $oldPlayerRanking->user_pt + $total_award_bonus)
                    ]);

                    PlayerRanking::where('user_id', $value->user_id)->where('race_management_id', $id)
                        ->update([
                            'double_circle' => in_array($value->double_circle, $double_win_award_array), 
                            'single_circle' => in_array($value->single_circle, $double_win_award_array),
                            'triangle' => in_array($value->triangle, $double_win_award_array),
                            'five_star' => in_array($value->five_star, $double_win_award_array),
                            'hole' => !in_array($value->hole, $delete_horses_data) && in_array($value->hole, $double_win_award_array),
                            'disappear' => in_array($value->disappear, $delete_horses_data) && !in_array($value->disappear, $double_win_award_array),
                            'user_pt' => $total_award_bonus,
                            'single_win_probability' => $single_win_probability,
                            'double_win_probability' => $double_win_probability,
                            'single_win' => $single_win,
                            'double_win_bonus' => $double_win_bonus,
                            'double_win' => $double_win,
                            'horse_racing_win' => $horse_racing_win,
                            'triple_racing_win' => $triplicate_win,
                    ]);
                }else{
                    $oldUser = User::find($value->user_id);

                    User::where('id', $value->user_id)->update([
                        'user_pt' => ($oldUser->user_pt + $total_award_bonus)
                    ]);

                    $player_ranking = new PlayerRanking();
                    $player_ranking->double_circle = in_array($value->double_circle, $double_win_award_array);
                    $player_ranking->single_circle = in_array($value->single_circle, $double_win_award_array);
                    $player_ranking->triangle = in_array($value->triangle, $double_win_award_array);
                    $player_ranking->five_star = in_array($value->five_star, $double_win_award_array);
                    $player_ranking->hole = !in_array($value->hole, $delete_horses_data) && in_array($value->hole, $double_win_award_array);
                    $player_ranking->disappear = in_array($value->disappear, $delete_horses_data) && !in_array($value->disappear, $double_win_award_array);
                    $player_ranking->user_pt = $total_award_bonus;
                    $player_ranking->single_win_probability = $single_win_probability;
                    $player_ranking->double_win_probability = $double_win_probability;
                    $player_ranking->user_id = $value->user_id;
                    $player_ranking->race_management_id = $id;
                    $player_ranking->single_win = $single_win;
                    $player_ranking->double_win_bonus = $double_win_bonus;
                    $player_ranking->double_win = $double_win;
                    $player_ranking->horse_racing_win = $horse_racing_win;
                    $player_ranking->triple_racing_win = $triplicate_win;
                    $player_ranking->save();
                }
                // # Individual player score calculation logic Begin #
            }
        }
        # Score calculation logic  Begin #

        $web_delete_horse_data = DeleteHorse::where('race_management_id', $id)->get();

        if (!count($web_delete_horse_data)) {
            # code...
            foreach ($delete_horses_data as $key => $value) {
                # code...      'rank' => '1着',
                $web_delete_horse = new DeleteHorse();
                $web_delete_horse->name = $value * 1;

                $web_delete_horse->race_management_id = $id;
                $web_delete_horse->save();
            }
        }else{

            $web_delete_horse_data = DeleteHorse::where('race_management_id', $id)->get();
            DeleteHorse::where('race_management_id', $id)->delete();

            foreach ($delete_horses_data as $key => $value) {
                # code...      'rank' => '1着',
                $web_delete_horse_ = new DeleteHorse();
                $web_delete_horse_->name = $value ? $value : $web_delete_horse_data[$key]['name'];
                $web_delete_horse_->race_management_id = $id;
                $web_delete_horse_->save();
            }

        }

        $response_data = RaceManagement::with('places')->with('running_horses')->with('web_race_results')->with('delete_horses')->get();
        return response()->json(['races_data' => $response_data]);
    }

    public function get_specific_race_data(Request $request){
        $response_data = RaceManagement::where('event_date', $request['changeDate'])->with('places')->with('running_horses')->with('web_race_results')->with('delete_horses')->get();
        return response()->json(['races_data' => $response_data]);
    }
}

