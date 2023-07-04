<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Horse;
class initfoodlist extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:foodlist';

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
        
        $horses = Horse::all();

        foreach ($horses as $key => $horse) {
        if($horse->etc != 1){
            Horse::where('id', $horse->id)->update([
                'stamina_b' => \DB::raw('stamina_b - 1'),
                'speed_b' => \DB::raw('speed_b - 1'),
                'strength_b' => \DB::raw('strength_b - 1'),
                'moment_b' => \DB::raw('moment_b - 1'),
                'happy' => \DB::raw('happy - 2'),
                'tired' => \DB::raw('tired + 2')
            ]);
        }
        }
    }
}
