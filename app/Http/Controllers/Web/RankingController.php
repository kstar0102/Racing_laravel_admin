<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\PlayerRanking;

class RankingController extends Controller
{
    //
    public function get_month(){
        $month = Carbon::today()->format('m');
        $currentMonth = Carbon::now()->month;

        $ranking_data = $this->get_ranking_data($currentMonth, 0);
        return response()->json(['ranking_data' => $ranking_data]);
    }

    public function get_year(){
        $currentYear = Carbon::now()->year;

        $ranking_data = $this->get_ranking_data($currentYear, 1);
        return response()->json(['ranking_data' => $ranking_data]);
    }

    public function first_half_year(){
        $ranking_data = $this->get_ranking_data('', 2);
        return response()->json(['ranking_data' => $ranking_data]);
    }

    public function second_half_year(){
        $ranking_data = $this->get_ranking_data('', 3);
        return response()->json(['ranking_data' => $ranking_data]);
    }

    public function get_ranking_data($check_value, $id){

        $uniqueUserData = PlayerRanking::all()->pluck('user_id')->unique();

        $ranking_data = [];
        
        foreach ($uniqueUserData as $key => $value) {
            # code...
            $data = [];
            if ($id == 0) {
                # code...
                $data = PlayerRanking::whereMonth('created_at', $check_value)->where('user_id', $value)->with('users')->get();
            }else if($id == 1){
                $data = PlayerRanking::whereYear('created_at', $check_value)->where('user_id', $value)->with('users')->get();
            }else if($id == 2){
                $data = PlayerRanking::whereMonth('created_at', '>=', 1)
                    ->whereMonth('created_at', '<=', 6)
                    ->where('user_id', $value)->with('users')
                    ->get();
            }else if($id == 3){
                $data = PlayerRanking::whereMonth('created_at', '>=', 7)
                    ->whereMonth('created_at', '<=', 12)
                    ->where('user_id', $value)->with('users')
                    ->get();
            }
            
            $ranking_number = count($data);

            if ($ranking_number) {
                $double_circle_percent = 0;
                $single_circle_percent = 0;
                $triangle_percent = 0;
                $five_star_percent = 0;
                $hole_percent = 0;
                $disappear_percent = 0;
                $point = 0;
                $single_win_probability = 0;
                $double_win_probability = 0;
                foreach ($data as $key => $item) {
                    # code...
                    if ($item->double_circle) {
                        # code...
                        $double_circle_percent++;
                    }
                    if ($item->single_circle) {
                        # code...
                        $single_circle_percent++;
                    }
                    if ($item->triangle) {
                        # code...
                        $triangle_percent++;
                    }
                    if ($item->five_star_percent) {
                        # code...
                        $five_star_percent++;
                    }
                    if ($item->hole) {
                        # code...
                        $hole_percent++;
                    }
                    if ($item->disappear) {
                        # code...
                        $disappear_percent++;
                    }
                    $point += $item->user_pt;
                    $single_win_probability += $item->single_win_probability;
                    $double_win_probability += $item->double_win_probability;
                }

                $old_ranking_data = array(
                    'name' => $data[0]->users->name,
                    'number_times' => count($data),
                    'point' => $point,
                    'double_circle' => $this->getDecimal(100 * $double_circle_percent / count($data)),
                    'single_circle' => $this->getDecimal(100 * $single_circle_percent / count($data)),
                    'triangle' => $this->getDecimal(100 * $triangle_percent / count($data)),
                    'five_star' => $this->getDecimal(100 * $five_star_percent / count($data)),
                    'hole' => $this->getDecimal(100 * $hole_percent / count($data)),
                    'disappear' => $this->getDecimal(100 * $disappear_percent / count($data)),
                    'single' => $single_win_probability / count($data),
                    'multiple' => $double_win_probability / count($data),
                );

                array_push($ranking_data, $old_ranking_data);
            }else {
                return [];
            }
            
        }

        // Adding index and sorting based on number_times
        usort($ranking_data, function($a, $b) {
            return $b['point'] - $a['point'];
        });
        foreach ($ranking_data as $key => $value) {
            $ranking_data[$key]['rank'] = $key + 1;
        }

        return $ranking_data;
    }

    public function getDecimal($value){
        if ($value == (int)$value) {
            return number_format($value, 0); // Display as integer
        } else {
            return number_format($value, 1); // Display with 1 decimal place
        }
        return $value;
    }
}
