<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\MessageEvent;
use Carbon\Carbon;
use App\Models\SaleHorse;
use App\Models\Horse;
use App\Models\Pasture;

class CheckAuctionState extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check_auction_state';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $current_time = Carbon::now();
        $startTime = Carbon::createFromTime(12, 0, 0);

        $sale_horse = new SaleHorse();
        foreach ($sale_horse->get() as $key => $value) {

            $dateTime = $value->created_at;

            if ($current_time->hour >= 12) {
              
                $endTime = $startTime->copy()->addRealHours($value->remain_bidding_time);
                $todayStart = Carbon::today()->startOfDay();
                $todayEnd = Carbon::today()->startOfDay()->addHours(12);
                $yesterdayStart = Carbon::yesterday()->startOfDay()->addHours(12);
                $yesterdayEnd = Carbon::today()->startOfDay();

                if ($dateTime->between($todayStart, $todayEnd) || $dateTime->between($yesterdayStart, $yesterdayEnd)) {
                    if ($endTime->isPast()) {
                        
                        if (!$value->highest_bidder) {
                            $sale_horse = SaleHorse::find($value->id);
                            $horse = $sale_horse->work_horses()->getResults(); 
                            $horse->sale_state = 0;
                            $horse->save();
                            // $sale_horse->delete();
                        }else {
                            $sale_horse = SaleHorse::find($value->id);
                            $horse = $sale_horse->work_horses()->getResults(); 
                            $horse->sale_state = 0;
                            $horse->user_id = $sale_horse->highest_bidder;
                            $pastureData = Pasture::where('user_id', $sale_horse->highest_bidder)->get();
                            $horse->pasture_id = $pastureData[0]->id;
                            $horse->save();
                            // $sale_horse->delete();
                        }
                    }
                }
            }else {

                $yesterdayStart = Carbon::yesterday()->startOfDay();
                $yesterdayEnd = Carbon::yesterday()->startOfDay()->addHours(12);
                $twoDaysAgoStart = Carbon::yesterday()->startOfDay()->addDays(-1)->addHours(12);
                $twoDaysAgoEnd = Carbon::yesterday()->startOfDay();
                $endTime = $yesterdayEnd->copy()->addRealHours($value->remain_bidding_time);
                
                if ($dateTime->between($yesterdayStart, $yesterdayEnd) || $dateTime->between($twoDaysAgoStart, $twoDaysAgoEnd)) {

                    if ($endTime->isPast()) {

                        if (!$value->highest_bidder) {
                            $sale_horse = SaleHorse::find($value->id);
                            $horse = $sale_horse->work_horses()->getResults(); 
                            $horse->sale_state = 0;
                            $horse->save();
                            // $sale_horse->delete();
                        }else {
                            $sale_horse = SaleHorse::find($value->id);
                            // \Log::info($sale_horse->highest_bidders->name);
                            $sale_horse = SaleHorse::find($value->id);
                            $horse = $sale_horse->work_horses()->getResults(); 
                            $horse->sale_state = 0;
                            $horse->user_id = $sale_horse->highest_bidder;
                            $horse->save();
                            // $sale_horse->delete();
                        }
                    }
                }
            }
            // broadcast(new MessageEvent('kh', 8000, 2, 7));
        }
    }
}