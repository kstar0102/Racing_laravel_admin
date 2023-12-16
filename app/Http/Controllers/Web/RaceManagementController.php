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
        $response_data = RaceManagement::with('places')->with('running_horses')->with('web_race_results')->with('delete_horses')->get();
        return response()->json(['races_data' => $response_data]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request) {

        $data = $request;
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
                $web_race_result->single = $value['single'];
                $web_race_result->double = $value['double'];
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
                $web_race_result->single = $value['single'];
                $web_race_result->double = $value['double'];
                $web_race_result->race_management_id = $id;
                $web_race_result->save();
            }
        }

        # Score calculation logic Begin #
        $getExpectedBattle = ExpectedBattle::where('race_management_id', $id)->get();
        \Log::info(count($getExpectedBattle));
        if (count($getExpectedBattle)) {

            foreach ($getExpectedBattle as $key => $value) {

                # Individual player score calculation logic Begin #
                $single_win_odd_award = 0;
                $prize_horse_award_array = [$race_result[0]['horse'],$race_result[1]['horse'],$race_result[2]['horse']];
                $mainArray = [$value->double_circle, $value->single_circle, $value->triangle, $value->five_star, $value->hole];
                if (in_array($prize_horse_award_array[0], $mainArray)) {
                    # code...
                    $single_win_odd_award += $race_result[0]['odds'];
                }
                if (in_array($prize_horse_award_array[1], $mainArray)) {
                    # code...
                    $single_win_odd_award += $race_result[1]['odds'];
                }
                if (in_array($prize_horse_award_array[2], $mainArray)) {
                    # code...
                    $single_win_odd_award += $race_result[2]['odds'];
                }

                $single_win_award = 0;
                if (in_array($race_result[0]['horse'],$mainArray)) {
                    # code...
                    $single_win_award += $race_result[0]['single'];
                }
                if (in_array($race_result[1]['horse'],$mainArray)) {
                    # code...
                    $single_win_award += $race_result[1]['single'];
                }
                if (in_array($race_result[2]['horse'],$mainArray)) {
                    # code...
                    $single_win_award += $race_result[2]['single'];
                }

                $single_win_award_bonus = 0;
                if ($mainArray[0] == $race_result[0]['horse']) {
                    # code...
                    $single_win_award_bonus += 200;
                }

                $double_win_award_bonus = 0;
                $double_win_award_array = [$race_result[0]['horse'],$race_result[1]['horse'],$race_result[2]['horse']];
                if (in_array($mainArray[0], $double_win_award_array)) {
                    # code...
                    $double_win_award_bonus += 100;
                }

                $horse_racing_award_bonus = 0;
                $horse_racing_award_array = [$race_result[0]['horse'],$race_result[1]['horse']];
                if (in_array($mainArray[0], $horse_racing_award_array) && in_array($mainArray[1], $horse_racing_award_array)) {
                    # code...
                    $horse_racing_award_bonus += 200;
                }
                if (in_array($mainArray[0], $horse_racing_award_array) && in_array($mainArray[2], $horse_racing_award_array)) {
                    # code...
                    $horse_racing_award_bonus += 150;
                }
                if (in_array($mainArray[0], $horse_racing_award_array) && in_array($mainArray[3], $horse_racing_award_array)) {
                    # code...
                    $horse_racing_award_bonus += 100;
                }
                if (in_array($mainArray[0], $horse_racing_award_array) && in_array($mainArray[4], $horse_racing_award_array)) {
                    # code...
                    $horse_racing_award_bonus += 50;
                }

                $triplicate_award_bonus = 0;
                
                if (in_array($mainArray[0], $prize_horse_award_array) && in_array($mainArray[1], $prize_horse_award_array) && in_array($mainArray[2], $prize_horse_award_array)) {
                    # code...
                    $triplicate_award_bonus += 500;
                }
                if (in_array($mainArray[0], $prize_horse_award_array) && in_array($mainArray[1], $prize_horse_award_array) && in_array($mainArray[3], $prize_horse_award_array)) {
                    # code...
                    $triplicate_award_bonus += 450;
                }
                if (in_array($mainArray[0], $prize_horse_award_array) && in_array($mainArray[1], $prize_horse_award_array) && in_array($mainArray[4], $prize_horse_award_array)) {
                    # code...
                    $triplicate_award_bonus += 400;
                }
                if (in_array($mainArray[0], $prize_horse_award_array) && in_array($mainArray[2], $prize_horse_award_array) && in_array($mainArray[3], $prize_horse_award_array)) {
                    # code...
                    $triplicate_award_bonus += 350;
                }
                if (in_array($mainArray[0], $prize_horse_award_array) && in_array($mainArray[2], $prize_horse_award_array) && in_array($mainArray[4], $prize_horse_award_array)) {
                    # code...
                    $triplicate_award_bonus += 300;
                }
                if (in_array($mainArray[0], $prize_horse_award_array) && in_array($mainArray[3], $prize_horse_award_array) && in_array($mainArray[4], $prize_horse_award_array)) {
                    # code...
                    $triplicate_award_bonus += 250;
                }
                if (in_array($mainArray[1], $prize_horse_award_array) && in_array($mainArray[2], $prize_horse_award_array) && in_array($mainArray[3], $prize_horse_award_array)) {
                    # code...
                    $triplicate_award_bonus += 200;
                }
                if (in_array($mainArray[1], $prize_horse_award_array) && in_array($mainArray[2], $prize_horse_award_array) && in_array($mainArray[4], $prize_horse_award_array)) {
                    # code...
                    $triplicate_award_bonus += 150;
                }
                if (in_array($mainArray[1], $prize_horse_award_array) && in_array($mainArray[3], $prize_horse_award_array) && in_array($mainArray[4], $prize_horse_award_array)) {
                    # code...
                    $triplicate_award_bonus += 100;
                }
                if (in_array($mainArray[2], $prize_horse_award_array) && in_array($mainArray[3], $prize_horse_award_array) && in_array($mainArray[4], $prize_horse_award_array)) {
                    # code...
                    $triplicate_award_bonus += 50;
                }
                \Log::info($triplicate_award_bonus);

                $delete_horse_award_bonus = 0;
                if (!in_array($value->disappear, $prize_horse_award_array)) {
                    switch ($value->disappear % 20) {
                        case 1:
                            $delete_horse_award_bonus += 50;
                            break;
                        case 2:
                            $delete_horse_award_bonus += 40;
                            break;
                        case 3:
                            $delete_horse_award_bonus += 30;
                            break;
                        case 4:
                            $delete_horse_award_bonus += 20;
                            break;
                        case 5:
                            $delete_horse_award_bonus += 10;
                            break;
                        default:
                            # code...
                            break;
                    }
                }

                $total_award_bonus = $single_win_odd_award + $single_win_award + $single_win_award_bonus + $double_win_award_bonus + $horse_racing_award_bonus + $triplicate_award_bonus + $delete_horse_award_bonus;

                # Individual player score calculation logic End #
                $getPlayerRanking = PlayerRanking::where('user_id', $value->user_id)->where('race_management_id',$id)->get();
                if (count($getPlayerRanking)) {
                    PlayerRanking::where('user_id', $value->user_id)->where('race_management_id', $id)
                        ->update([
                            'double_circle' => in_array($value->double_circle, $prize_horse_award_array), 
                            'single_circle' => in_array($value->single_circle, $prize_horse_award_array),
                            'triangle' => in_array($value->triangle, $prize_horse_award_array),
                            'five_star' => in_array($value->five_star, $prize_horse_award_array),
                            'hole' => !in_array($value->hole, $prize_horse_award_array),
                            'disappear' => !in_array($value->disappear, $prize_horse_award_array),
                            'user_pt' => $total_award_bonus,
                    ]);
                }else{
                    $player_ranking = new PlayerRanking();
                    $player_ranking->double_circle = in_array($value->double_circle, $prize_horse_award_array);
                    $player_ranking->single_circle = in_array($value->single_circle, $prize_horse_award_array);
                    $player_ranking->triangle = in_array($value->triangle, $prize_horse_award_array);
                    $player_ranking->five_star = in_array($value->five_star, $prize_horse_award_array);
                    $player_ranking->hole = !in_array($value->hole, $prize_horse_award_array);
                    $player_ranking->disappear = !in_array($value->disappear, $prize_horse_award_array);
                    $player_ranking->user_pt = $total_award_bonus;
                    $player_ranking->user_id = $value->user_id;
                    $player_ranking->race_management_id = $id;
                    $player_ranking->save();
                }
                # Individual player score calculation logic Begin #
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

