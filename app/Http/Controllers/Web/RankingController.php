<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\PlayerRanking;
use App\Models\ExpectedBattle;
use App\Models\User;

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
        $currentYear = Carbon::now()->year;

        $ranking_data = $this->get_ranking_data($currentYear, 2);
        return response()->json(['ranking_data' => $ranking_data]);
    }

    public function second_half_year(){
        $currentYear = Carbon::now()->year;

        $ranking_data = $this->get_ranking_data($currentYear, 3);
        return response()->json(['ranking_data' => $ranking_data]);
    }


    public function get_mypage_userdata($id){
        $currentYear = Carbon::now()->year;

        $month = Carbon::today()->format('m');
        $currentMonth = Carbon::now()->month;
        $month_data = PlayerRanking::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->where('user_id', $id)->with('users')
            ->get();
        $month_ranking_data = $this->get_my_rank_data($month_data);

        $year_data = PlayerRanking::whereYear('created_at', $currentYear)->where('user_id', $id)->with('users')->get();
        $year_ranking_data = $this->get_my_rank_data($year_data);

        $first_half_year_data = PlayerRanking::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', '>=', 1)
            ->whereMonth('created_at', '<=', 6)
            ->where('user_id', $id)->with('users')
            ->get();
        $first_half_year_ranking_data = $this->get_my_rank_data($first_half_year_data);

        $second_half_year_data = PlayerRanking::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', '>=', 7)
            ->whereMonth('created_at', '<=', 12)
            ->where('user_id', $id)->with('users')
            ->get();
        $second_half_year_ranking_data = $this->get_my_rank_data($second_half_year_data);

        $total_player_ranking_data = PlayerRanking::where('user_id', $id)->with('race_managements')->get();
        $new_total_player_ranking_data = array();

        $times = count($total_player_ranking_data);
        $first_hit_rate = 0;

        $single_win = 0;
        $double_win = 0;
        $horse_racing_win = 0;
        $triple_racing_win = 0;

        foreach ($total_player_ranking_data as $key => $value) {
            # code...
            $addValue = ExpectedBattle::where('user_id', $id)->where('race_management_id', $value->race_managements->id)->with('double_circles')->with('single_circles')->with('triangles')->with('five_stars')->with('holes')->with('disappears')->first();
            $array1 = json_decode($addValue, true);
            $array2 = json_decode($value, true);
            $newArray = array_merge($array1, $array2);
            array_push($new_total_player_ranking_data, $newArray);
            $first_hit_rate += $value['double_circle'] * 100;
            $single_win += $value['single_win'];
            $double_win += $value['double_win_bonus'];
            $horse_racing_win += $value['horse_racing_win'];
            $triple_racing_win += $value['triple_racing_win'];
        }

        $badge_grade;
        if ($times ==0 || 10 > ($first_hit_rate / $times)) {
            $badge_grade = 9;
        }else if (($first_hit_rate / $times) >= 90) {
            $badge_grade = 0;
        } else if (90 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 80) {
            $badge_grade = 1;
        } else if(80 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 70) {
            $badge_grade = 2;
        } else if (70 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 60) {
            $badge_grade = 3;
        } else if (60 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 50) {
            $badge_grade = 4;
        } else if (50 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 40) {
            $badge_grade = 5;
        } else if (40 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 30) {
            $badge_grade = 6;
        } else if (30 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 20) {
            $badge_grade = 7;
        } else if (20 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 10) {
            $badge_grade = 8;
        }
         
        $total_ranking_data = [
            'times' => $times,
            'badge_grade' => $badge_grade,
            'single_win' => $single_win,
            'double_win' => $double_win,
            'horse_racing_win' => $horse_racing_win,
            'triple_racing_win' => $triple_racing_win,
            'total_ranking_data' => $new_total_player_ranking_data,
            'month_ranking_data' => $month_ranking_data,
            'year_ranking_data' => $year_ranking_data,
            'first_half_year_ranking_data' => $first_half_year_ranking_data,
            'second_half_year_ranking_data' => $second_half_year_ranking_data
        ];
        return response()->json(['my_ranking_data' => $total_ranking_data]);
    }

    public function get_grade_management_userdata(){
        $all_user_data = User::all();
        
        $total_user_data = array();
        foreach ($all_user_data as $person_key => $person_data) {
            $currentYear = Carbon::now()->year;

            $month = Carbon::today()->format('m');
            $currentMonth = Carbon::now()->month;
            $month_data = PlayerRanking::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $currentMonth)
                ->where('user_id', $person_data->id)->with('users')
                ->get();
            $month_ranking_data = $this->get_my_rank_data($month_data);

            $year_data = PlayerRanking::whereYear('created_at', $currentYear)->where('user_id', $person_data->id)->with('users')->get();
            $year_ranking_data = $this->get_my_rank_data($year_data);

            $first_half_year_data = PlayerRanking::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', '>=', 1)
                ->whereMonth('created_at', '<=', 6)
                ->where('user_id', $person_data->id)->with('users')
                ->get();
            $first_half_year_ranking_data = $this->get_my_rank_data($first_half_year_data);

            $second_half_year_data = PlayerRanking::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', '>=', 7)
                ->whereMonth('created_at', '<=', 12)
                ->where('user_id', $person_data->id)->with('users')
                ->get();
            $second_half_year_ranking_data = $this->get_my_rank_data($second_half_year_data);

            $total_player_ranking_data = PlayerRanking::where('user_id', $person_data->id)->with('race_managements')->get();
            $new_total_player_ranking_data = array();

            $times = count($total_player_ranking_data);
            $first_hit_rate = 0;

            $single_win = 0;
            $double_win = 0;
            $horse_racing_win = 0;
            $triple_racing_win = 0;
            $win_award = 0;
            
            foreach ($total_player_ranking_data as $key => $value) {
                # code...
                $addValue = ExpectedBattle::where('user_id', $person_data->id)->where('race_management_id', $value->race_managements->id)->with('double_circles')->with('single_circles')->with('triangles')->with('five_stars')->with('holes')->with('disappears')->first();
                $array1 = json_decode($addValue, true);
                $array2 = json_decode($value, true);
                $newArray = array_merge($array1, $array2);
                array_push($new_total_player_ranking_data, $newArray);
                $first_hit_rate += $value['double_circle'] * 100;
                $single_win += $value['single_win'];
                $double_win += $value['double_win_bonus'];
                $horse_racing_win += $value['horse_racing_win'];
                $triple_racing_win += $value['triple_racing_win'];
                $win_award += $value['user_pt'];
            }

            $badge_grade;
            if ($times ==0 || 10 > ($first_hit_rate / $times)) {
                $badge_grade = 9;
            }else if (($first_hit_rate / $times) >= 90) {
                $badge_grade = 0;
            } else if (90 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 80) {
                $badge_grade = 1;
            } else if(80 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 70) {
                $badge_grade = 2;
            } else if (70 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 60) {
                $badge_grade = 3;
            } else if (60 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 50) {
                $badge_grade = 4;
            } else if (50 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 40) {
                $badge_grade = 5;
            } else if (40 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 30) {
                $badge_grade = 6;
            } else if (30 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 20) {
                $badge_grade = 7;
            } else if (20 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 10) {
                $badge_grade = 8;
            }

            $user_data = [
                'id' => $person_key,
                'times' => $times,
                'win_award' => $win_award,
                'user_name' => $person_data->login_id,
                'user_image_url' => $person_data->image_url,
                'badge_grade' => $badge_grade,
                'single_win' => $single_win,
                'double_win' => $double_win,
                'horse_racing_win' => $horse_racing_win,
                'triple_racing_win' => $triple_racing_win,
                'total_ranking_data' => $new_total_player_ranking_data,
                'month_ranking_data' => $month_ranking_data,
                'year_ranking_data' => $year_ranking_data,
                'first_half_year_ranking_data' => $first_half_year_ranking_data,
                'second_half_year_ranking_data' => $second_half_year_ranking_data
            ];

            array_push($total_user_data, $user_data);

        }
        // Extract the 'single_win' column for sorting
        $win_award = array_column($total_user_data, 'win_award');

        // Sort the $total_user_data array based on the 'single_win' column
        array_multisort($win_award, SORT_DESC, $total_user_data);

        return response()->json(['grade_management_data' => $total_user_data]);
    }

    public function get_home_data(){
        $currentYear = Carbon::now()->year;

        // 毎月のデータ統計 //
        $month_data = $this->get_ranking_data(1, 0);
        $point_month_data = [];
        $double_circle_month_data = [];
        $single_month_data = [];
        $multiple_month_data = [];

        if (count($month_data)) {
            usort($month_data, function ($a, $b) {
                return $b['point'] <=> $a['point'];
            });
            $filtered_point_month_data = array_map(function ($item) {
                return [
                    'name' => $item['name'],
                    'number_times' => $item['number_times'],
                    'point' => $item['point']
                ];
            }, $month_data);
            $point_month_data = $filtered_point_month_data;
        }

        if (count($month_data)) {
            usort($month_data, function ($a, $b) {
                return $b['double_circle'] <=> $a['double_circle'];
            });
            $filtered_double_circle_month_data  = array_map(function ($item) {
                return [
                    'name' => $item['name'],
                    'number_times' => $item['number_times'],
                    'double_circle' => $item['double_circle']
                ];
            }, $month_data);
            $double_circle_month_data = $filtered_double_circle_month_data;
        }

        if (count($month_data)) {
            usort($month_data, function ($a, $b) {
                return $b['single'] <=> $a['single'];
            });
            $filtered_single_month_data = array_map(function ($item) {
                return [
                    'name' => $item['name'],
                    'number_times' => $item['number_times'],
                    'single' => $item['single']
                ];
            }, $month_data);
            $single_month_data = $filtered_single_month_data;
        }

        if (count($month_data)) {
            usort($month_data, function ($a, $b) {
                return $b['multiple'] <=> $a['multiple'];
            });
            $filtered_multiple_month_data = array_map(function ($item) {
                return [
                    'name' => $item['name'],
                    'number_times' => $item['number_times'],
                    'multiple' => $item['multiple']
                ];
            }, $month_data);
            $multiple_month_data = $filtered_multiple_month_data;
        }

        // 上半年のデータ統計 //
        $first_half_year_data = $this->get_ranking_data($currentYear, 2);
        $point_first_half_year_data = [];
        $double_circle_first_half_year_data = [];
        $single_first_half_year_data = [];
        $multiple_first_half_year_data = [];

        if (count($first_half_year_data)) {
            usort($first_half_year_data, function ($a, $b) {
                return $b['point'] <=> $a['point'];
            });
            $filtered_point_first_half_year_data = array_map(function ($item) {
                return [
                    'name' => $item['name'],
                    'number_times' => $item['number_times'],
                    'point' => $item['point']
                ];
            }, $first_half_year_data);
            $point_first_half_year_data = $filtered_point_first_half_year_data;
        }

        if (count($first_half_year_data)) {
            usort($first_half_year_data, function ($a, $b) {
                return $b['double_circle'] <=> $a['double_circle'];
            });
            $filtered_double_circle_first_half_year_data = array_map(function ($item) {
                return [
                    'name' => $item['name'],
                    'number_times' => $item['number_times'],
                    'double_circle' => $item['double_circle']
                ];
            }, $first_half_year_data);
            $double_circle_first_half_year_data = $filtered_double_circle_first_half_year_data;
        }

        if (count($first_half_year_data)) {
            usort($first_half_year_data, function ($a, $b) {
                return $b['single'] <=> $a['single'];
            });
            $filtered_single_first_half_year_data = array_map(function ($item) {
                return [
                    'name' => $item['name'],
                    'number_times' => $item['number_times'],
                    'single' => $item['single']
                ];
            }, $first_half_year_data);
            $single_first_half_year_data = $filtered_single_first_half_year_data;
        }

        if (count($first_half_year_data)) {
            usort($first_half_year_data, function ($a, $b) {
                return $b['multiple'] <=> $a['multiple'];
            });
            $filtered_multiple_first_half_year_data = array_map(function ($item) {
                return [
                    'name' => $item['name'],
                    'number_times' => $item['number_times'],
                    'multiple' => $item['multiple']
                ];
            }, $first_half_year_data);
            $multiple_first_half_year_data = $filtered_multiple_first_half_year_data;
        }

        // 毎年のデータ統計 //
        $year_data = $this->get_ranking_data($currentYear, 1);
        $point_year_data = [];
        $double_circle_year_data = [];
        $single_year_data = [];
        $multiple_year_data = [];

        if (count($year_data)) {
            usort($year_data, function ($a, $b) {
                return $b['point'] <=> $a['point'];
            });
            $filtered_point_year_data = array_map(function ($item) {
                return [
                    'name' => $item['name'],
                    'number_times' => $item['number_times'],
                    'point' => $item['point']
                ];
            }, $year_data);
            $point_year_data = $filtered_point_year_data;
        }

        if (count($year_data)) {
            usort($year_data, function ($a, $b) {
                return $b['double_circle'] <=> $a['double_circle'];
            });
            $filtered_double_circle_year_data = array_map(function ($item) {
                return [
                    'name' => $item['name'],
                    'number_times' => $item['number_times'],
                    'double_circle' => $item['double_circle']
                ];
            }, $year_data);
            $double_circle_year_data = $filtered_double_circle_year_data;
        }

        if (count($year_data)) {
            usort($year_data, function ($a, $b) {
                return $b['single'] <=> $a['single'];
            });
            $filtered_single_year_data = array_map(function ($item) {
                return [
                    'name' => $item['name'],
                    'number_times' => $item['number_times'],
                    'single' => $item['single']
                ];
            }, $year_data);
            $single_year_data = $filtered_single_year_data;
        }

        if (count($year_data)) {
            usort($year_data, function ($a, $b) {
                return $b['multiple'] <=> $a['multiple'];
            });
            $filtered_multiple_year_data = array_map(function ($item) {
                return [
                    'name' => $item['name'],
                    'number_times' => $item['number_times'],
                    'multiple' => $item['multiple']
                ];
            }, $year_data);
            $multiple_year_data = $filtered_multiple_year_data;
        }

        return response()->json([
            'point_month_data' => $point_month_data,
            'double_circle_month_data' => $double_circle_month_data,
            'single_month_data' => $single_month_data,
            'multiple_month_data' => $multiple_month_data,
            'point_first_half_year_data' => $point_first_half_year_data,
            'double_circle_first_half_year_data' => $double_circle_first_half_year_data,
            'single_first_half_year_data' => $single_first_half_year_data,
            'multiple_first_half_year_data' => $multiple_first_half_year_data,
            'point_year_data' => $point_year_data,
            'double_circle_year_data' => $double_circle_year_data,
            'single_year_data' => $single_year_data,
            'multiple_year_data' => $multiple_year_data,
        ]);
    }

    public function get_user_management_userdata(){
        $all_user_data = User::all();
        
        $total_user_data = array();
        foreach ($all_user_data as $person_key => $person_data) {
            $total_player_ranking_data = PlayerRanking::where('user_id', $person_data->id)->with('race_managements')->get();

            $times = count($total_player_ranking_data);
            $first_hit_rate = 0;
            $win_award = 0;
            
            foreach ($total_player_ranking_data as $key => $value) {
                # code...
                $first_hit_rate += $value['double_circle'] * 100;
                $win_award += $value['user_pt'];
            }

            $badge_grade;
            if ($times ==0 || 10 > ($first_hit_rate / $times)) {
                $badge_grade = 9;
            }else if (($first_hit_rate / $times) >= 90) {
                $badge_grade = 0;
            } else if (90 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 80) {
                $badge_grade = 1;
            } else if(80 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 70) {
                $badge_grade = 2;
            } else if (70 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 60) {
                $badge_grade = 3;
            } else if (60 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 50) {
                $badge_grade = 4;
            } else if (50 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 40) {
                $badge_grade = 5;
            } else if (40 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 30) {
                $badge_grade = 6;
            } else if (30 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 20) {
                $badge_grade = 7;
            } else if (20 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 10) {
                $badge_grade = 8;
            }

            $user_data = [
                'id' => $person_key + 1,
                'user_name' => $person_data->login_id,
                'user_role' => $person_data->role,
                'user_image_url' => $person_data->image_url,
                'badge_grade' => $badge_grade,
                'win_award' => $win_award,
                'real_id' => $person_data->id,
            ];

            array_push($total_user_data, $user_data);

        }

        return response()->json(['user_management_data' => $total_user_data]);
    }

    
    public function update_user_management_userdata(Request $request, string $id){
        User::where('id', $id)->update([
            'login_id' => $request['user_name'],
            'role' => $request['user_role']
        ]);
        
        $all_user_data = User::all();
        
        $total_user_data = array();
        foreach ($all_user_data as $person_key => $person_data) {
            $total_player_ranking_data = PlayerRanking::where('user_id', $person_data->id)->with('race_managements')->get();

            $times = count($total_player_ranking_data);
            $first_hit_rate = 0;
            $win_award = 0;
            
            foreach ($total_player_ranking_data as $key => $value) {
                # code...
                $first_hit_rate += $value['double_circle'] * 100;
                $win_award += $value['user_pt'];
            }

            $badge_grade;
            if ($times ==0 || 10 > ($first_hit_rate / $times)) {
                $badge_grade = 9;
            }else if (($first_hit_rate / $times) >= 90) {
                $badge_grade = 0;
            } else if (90 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 80) {
                $badge_grade = 1;
            } else if(80 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 70) {
                $badge_grade = 2;
            } else if (70 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 60) {
                $badge_grade = 3;
            } else if (60 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 50) {
                $badge_grade = 4;
            } else if (50 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 40) {
                $badge_grade = 5;
            } else if (40 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 30) {
                $badge_grade = 6;
            } else if (30 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 20) {
                $badge_grade = 7;
            } else if (20 > ($first_hit_rate / $times) && ($first_hit_rate / $times) >= 10) {
                $badge_grade = 8;
            }

            $user_data = [
                'id' => $person_key + 1,
                'user_name' => $person_data->login_id,
                'user_role' => $person_data->role,
                'user_image_url' => $person_data->image_url,
                'badge_grade' => $badge_grade,
                'win_award' => $win_award,
                'real_id' => $person_data->id,
            ];

            array_push($total_user_data, $user_data);

        }

        return response()->json(['user_management_data' => $total_user_data]);
    }

    public function get_ranking_data($check_value, $id){
        $currentYear = Carbon::now()->year;

        $uniqueUserData = PlayerRanking::all()->pluck('user_id')->unique();

        $ranking_data = [];

        foreach ($uniqueUserData as $key => $value) {
            # code...
            $data = [];
            if ($id == 0) {
                # code...
                $data = PlayerRanking::whereYear('created_at', $currentYear)
                    ->whereMonth('created_at', $check_value)
                    ->where('user_id', $value)->with('users')->get();
            }else if($id == 1){
                $data = PlayerRanking::whereYear('created_at', $check_value)
                    ->where('user_id', $value)->with('users')
                    ->get();
            }else if($id == 2){
                $data = PlayerRanking::whereYear('created_at', $check_value)
                    ->whereMonth('created_at', '>=', 1)
                    ->whereMonth('created_at', '<=', 6)
                    ->where('user_id', $value)->with('users')
                    ->get();
            }else if($id == 3){
                $data = PlayerRanking::whereYear('created_at', $check_value)
                    ->whereMonth('created_at', '>=', 7)
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
                    'name' => $data[0]->users->login_id,
                    'number_times' => count($data),
                    'point' => $point,
                    'double_circle' => count($data) ? $this->getDecimal(100 * $double_circle_percent / count($data)) : 0,
                    'single_circle' => count($data) ? $this->getDecimal(100 * $single_circle_percent / count($data)) : 0,
                    'triangle' => count($data) ? $this->getDecimal(100 * $triangle_percent / count($data)) : 0,
                    'five_star' => count($data) ? $this->getDecimal(100 * $five_star_percent / count($data)) : 0,
                    'hole' => count($data) ? $this->getDecimal(100 * $hole_percent / count($data)) : 0,
                    'disappear' => count($data) ? $this->getDecimal(100 * $disappear_percent / count($data)) : 0,
                    'single' => count($data) ? $this->getDecimal($single_win_probability / count($data)) : 0,
                    'multiple' => count($data) ? $this->getDecimal($double_win_probability / count($data)) : 0,
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

    public function get_my_rank_data($data){
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
            if ($item->double_circle) {
                $double_circle_percent++;
            }
            if ($item->single_circle) {
                $single_circle_percent++;
            }
            if ($item->triangle) {
                $triangle_percent++;
            }
            if ($item->five_star_percent) {
                $five_star_percent++;
            }
            if ($item->hole) {
                $hole_percent++;
            }
            if ($item->disappear) {
                $disappear_percent++;
            }
            $point += $item->user_pt;
            $single_win_probability += $item->single_win_probability;
            $double_win_probability += $item->double_win_probability;
        }

        return array(
            'point' => $point,
            'double_circle' => count($data) ? $this->getDecimal(100 * $double_circle_percent / count($data)) : 0,
            'single_circle' => count($data) ? $this->getDecimal(100 * $single_circle_percent / count($data)) : 0,
            'triangle' => count($data) ? $this->getDecimal(100 * $triangle_percent / count($data)) : 0,
            'five_star' => count($data) ? $this->getDecimal(100 * $five_star_percent / count($data)) : 0,
            'hole' => count($data) ? $this->getDecimal(100 * $hole_percent / count($data)) : 0,
            'disappear' => count($data) ? $this->getDecimal(100 * $disappear_percent / count($data)) : 0,
            'single' => count($data) ? $this->getDecimal($single_win_probability / count($data)) : 0,
            'multiple' => count($data) ? $this->getDecimal($double_win_probability / count($data)) : 0,
        );
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
