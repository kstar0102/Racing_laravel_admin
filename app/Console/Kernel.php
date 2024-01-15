<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\reserveFood::class,
        Commands\food::class,
        Commands\initfoodlist::class,
        Commands\CheckAuctionState::class,
        Commands\ManageAuctionState::class
    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        // $schedule->command('inspire')->hourly();
        
        $schedule->command('reserve:food')->everyMinute();
        $schedule->command('deadline:food')->everyMinute();
        $schedule->command('init:foodlist')->everyMinute();
        $schedule->command('check_auction_state')->everyMinute();
        $schedule->command('manage_auction_state')->dailyAt('12:00');
        // $schedule->command('manage_auction_state')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    // protected function commands()
    // {
    //     $this->load(__DIR__.'/Commands');

    //     require base_path('routes/console.php');
    // }
}
