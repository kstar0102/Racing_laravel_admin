<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ReserveFood as Foods;

class reserveFood extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reserve:food';

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
        $data = Foods::select('food_name', \DB::raw('MIN(user_id) as user_id'))
            ->groupBy('user_id')
            ->get();
        
        \Log::info($data);
    }
}
