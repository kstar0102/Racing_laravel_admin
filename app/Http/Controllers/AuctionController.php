<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horse;
use App\Models\User;
use App\Models\SaleHorse;
use App\Events\MessageEvent;
use Carbon\Carbon;

class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        \Log::info("test mode");
    }

    public function getSaleHorse($id){
        $current_time = Carbon::now();

        if ($current_time->hour >= 12) {
            # code...
            $previous_day_start = Carbon::yesterday()->setTime(12, 0, 0);
            $previous_day_end = Carbon::now()->setTime(12, 0, 0);
            $sale_horses = SaleHorse::with('work_horses.users')
                            ->with('highest_bidders')
                            ->whereBetween('created_at', [$previous_day_start, $previous_day_end])
                            ->orderBy('created_at', 'desc')
                            ->get();
            $filtered_sale_horses = $sale_horses->filter(function ($sale_horse) use ($id) {
                return $sale_horse->work_horses->user_id != $id;
            });
            return response()->json(['sale_horse' => $filtered_sale_horses]);
        }else {
            $previous_day_end = Carbon::yesterday()->setTime(12, 0, 0);
            $previous_day_start = Carbon::now()->subDays(2)->setTime(12, 0, 0);
            $sale_horses = SaleHorse::with('work_horses.users')
                            ->with('highest_bidders')
                            ->whereBetween('created_at', [$previous_day_start, $previous_day_end])
                            ->orderBy('created_at', 'desc')
                            ->get();
            $filtered_sale_horses = $sale_horses->filter(function ($sale_horse) use ($id) {
                return $sale_horse->work_horses->user_id != $id;
            });
            return response()->json(['sale_horse' => $filtered_sale_horses]);
        }
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
        $horse_id = $request->input('horse_id');
        $user_id = $request->input('user_id');
        $pasture_id = $request->input('pasture_id');

        $horse = Horse::find($horse_id);
        $horse->sale_state = true;
        $horse->save();

        $sale_horse = new SaleHorse();
        $sale_horse->horse_id = $horse_id;
        $sale_horse->save();

        $horses = Horse::where('user_id', $user_id)->where('pasture_id', $pasture_id)->get();

        $user = User::find($user_id);
        $user->user_pt -= $horse->etc / 10;
        $user->save();
        $newUser = User::where('id', $user_id)->get();

        return response()->json(['user' => $newUser, 'horses' => $horses]);
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
        $sale_horse = SaleHorse::find($id);
        $sale_horse->highest_bidder = $request->input('bidder');
        $sale_horse->highest_bid_amount = $request->input('bid_amount');
        
        $sale_horse->save();

        $current_time = Carbon::now();
        if ($current_time->hour >= 12) {
            $startTime = Carbon::createFromTime(12, 0, 0); // Create a Carbon instance for 12 o'clock
            \Log::info($sale_horse->remain_bidding_time);
            $endTime = $startTime->copy()->addRealHours($sale_horse->remain_bidding_time);
            
            \Log::info($sale_horse->updated_at);
            $remainTime = $endTime->diffInSeconds($sale_horse->updated_at) / 60 / 60;
            \Log::info($remainTime);
            if ($remainTime < 1) {
                # code...
                $addTime = 1 - $remainTime;
                \Log::info($addTime);
                $sale_horse->remain_bidding_time += $addTime;
                \Log::info($sale_horse->remain_bidding_time);
            }

            $sale_horse->save();
        }

        broadcast(new MessageEvent($sale_horse->highest_bidders()->getResults()->name, $request->input('bid_amount'), $id, $sale_horse->remain_bidding_time));
        return response()->json(['result'], 200);
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
