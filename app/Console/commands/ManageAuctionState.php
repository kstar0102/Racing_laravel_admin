<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\SaleHorse;
use App\Models\Horse;
use App\Models\Lineage;
use App\Events\SaleHorsesEvent;

class ManageAuctionState extends Command
{
    public $saleHorseData;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'manage_auction_state';

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

    public function randomShow($age_type)
    {
        $growth_rand = ["早め", "普通", "晩成", "遅め", "早熟", "持続"];
        $ground_rand = ["芝", "ダ", "万"];
        $quality_leg_rand = ["自", "先", "逃", "追", "差", "大逃"];
        $gender_rand = ["牝", "牡"];
        $factor_2_rand = [60, 120, 30, 75];
        $factor_3_rand = [70, 100, 100, 150];


        $color = $this->setColor();
        $growth = $growth_rand[array_rand($growth_rand)];
        $ground = $ground_rand[array_rand($ground_rand)];
        $quality_leg = $quality_leg_rand[array_rand($quality_leg_rand)];
        $gender = $gender_rand[array_rand($gender_rand)];

        if ($age_type == '繁殖馬') {
            # code...\
            $age = "・6歳馬";
            $type = $age_type;
        }else {
            # code...
            $age = $age_type;
            $type = "";
        }

        if ($age_type == "・0歳馬") {
            $per_mark = $this->setPattern($age_type);
            switch ($per_mark) {
                case 'D':
                    $factor_1_rand = [0, 40, 0, 10];
                    $price = 1000;
                    break;
                case 'C':
                    $factor_1_rand = [40, 80, 10, 20];
                    $price = rand(10, 40) * 100;
                    break;
                case 'B':
                    $factor_1_rand = [80, 120, 20, 30];
                    $price = rand(10, 60) * 100;
                    break;
                case 'A':
                    $factor_1_rand = [120, 160, 30, 40];
                    $price = rand(10, 80) * 100;
                    break;
                case 'S':
                    $factor_1_rand = [160, 200, 40, 50];
                    $price = rand(10, 100) * 100;
                    break;
            }
            $speed_b = rand($factor_1_rand[0], $factor_1_rand[1]);
            $strength_b = rand($factor_1_rand[0], $factor_1_rand[1]);
            $stamina_b = rand($factor_1_rand[0], $factor_1_rand[1]);
            $moment_b = rand($factor_1_rand[0], $factor_1_rand[1]);
            $condition_b = rand($factor_1_rand[0], $factor_1_rand[1]);
            $health_b = rand($factor_1_rand[0], $factor_1_rand[1]);
            $speed_w = rand($factor_1_rand[2], $factor_1_rand[3]);
            $strength_w = rand($factor_1_rand[2], $factor_1_rand[3]);
            $stamina_w = rand($factor_1_rand[2], $factor_1_rand[3]);
            $moment_w = rand($factor_1_rand[2], $factor_1_rand[3]);
            $condition_w = rand($factor_1_rand[2], $factor_1_rand[3]);
            $health_w = rand($factor_1_rand[2], $factor_1_rand[3]);
        } else if ($age_type == "・1歳馬") {
            $per_mark = $this->setPattern($age_type);
            switch ($per_mark) {
                case 'D':
                    $factor_1_rand = [50, 64, 30, 39];
                    $price = 2000;
                    break;
                case 'C':
                    $factor_1_rand = [64, 78, 39, 48];
                    $price = rand(20, 60) * 100;
                    break;
                case 'B':
                    $factor_1_rand = [78, 92, 48, 57];
                    $price = rand(20, 90) * 100;
                    break;
                case 'A':
                    $factor_1_rand = [92, 106, 57, 66];
                    $price = rand(20, 120) * 100;
                    break;
                case 'S':
                    $factor_1_rand = [106, 120, 66, 75];
                    $price = rand(20, 150) * 100;
                    break;
            }
            $speed_b = rand($factor_2_rand[0], $factor_2_rand[1]);
            $strength_b = rand($factor_2_rand[0], $factor_2_rand[1]);
            $stamina_b = rand($factor_2_rand[0], $factor_2_rand[1]);
            $moment_b = rand($factor_2_rand[0], $factor_2_rand[1]);
            $condition_b = rand($factor_2_rand[0], $factor_2_rand[1]);
            $health_b = rand($factor_2_rand[0], $factor_2_rand[1]);
            $speed_w = rand($factor_2_rand[2], $factor_2_rand[3]);
            $strength_w = rand($factor_2_rand[2], $factor_2_rand[3]);
            $stamina_w = rand($factor_2_rand[2], $factor_2_rand[3]);
            $moment_w = rand($factor_2_rand[2], $factor_2_rand[3]);
            $condition_w = rand($factor_2_rand[2], $factor_2_rand[3]);
            $health_w = rand($factor_2_rand[2], $factor_2_rand[3]);
        } else {
            $per_mark = $this->setPattern($age_type);
            switch ($per_mark) {
                case 'D':
                    $factor_1_rand = [70, 80, 100, 110];
                    $price = 3000;
                    break;
                case 'C':
                    $factor_1_rand = [80, 90, 110, 120];
                    $price = rand(30, 150) * 100;
                    break;
                case 'B':
                    $factor_1_rand = [90, 100, 120, 130];
                    $price = rand(30, 200) * 100;
                    break;
                case 'A':
                    $factor_1_rand = [100, 110, 130, 140];
                    $price = rand(30, 250) * 100;
                    break;  
                case 'S':
                    $factor_1_rand = [110, 120, 140, 150];
                    $price = rand(20, 300) * 100;
                    break;
            }
            $speed_b = rand($factor_3_rand[0], $factor_3_rand[1]);
            $strength_b = rand($factor_3_rand[0], $factor_3_rand[1]);
            $stamina_b = rand($factor_3_rand[0], $factor_3_rand[1]);
            $moment_b = rand($factor_3_rand[0], $factor_3_rand[1]);
            $condition_b = rand($factor_3_rand[0], $factor_3_rand[1]);
            $health_b = rand($factor_3_rand[0], $factor_3_rand[1]);
            $speed_w = rand($factor_3_rand[2], $factor_3_rand[3]);
            $strength_w = rand($factor_3_rand[2], $factor_3_rand[3]);
            $stamina_w = rand($factor_3_rand[2], $factor_3_rand[3]);
            $moment_w = rand($factor_3_rand[2], $factor_3_rand[3]);
            $condition_w = rand($factor_3_rand[2], $factor_3_rand[3]);
            $health_w = rand($factor_3_rand[2], $factor_3_rand[3]);
        }

        $lineage = Lineage::inRandomOrder()->take(1)->get();

        $randomValue = rand(0, 4);
        $distance_array = ["短", "短中", "中", "中長", "長"];

        $max_distance = 0;
        $min_distance = 0;
        switch ($distance_array[$randomValue]) {
            case "短":
                $max_distance = 1000;
                $min_distance = 1600;
                break;
            case "短中":
                $max_distance = 1400;
                $min_distance = 2000;
                break;
            case "中":
                $max_distance = 1800;
                $min_distance = 2400;
                break;
            case "中長":
                $max_distance = 2200;
                $min_distance = 2800;
                break;
            case "長":
                $max_distance = 3000;
                $min_distance = 3600;
                break;
            default:
                echo "Invalid pattern";
                break;
        }

        $horseData = new Horse;
        foreach ($lineage as $key => $value) {
            $horseData->name = $value['name'];
            $horseData->gender = $gender;
            $horseData->age = $age;
            $horseData->price = $price;
            $horseData->type = $type;
            $horseData->class = "";
            $horseData->happy = "10";
            $horseData->tired = "0";
            $horseData->direction = 1;
            $horseData->state = 1;
            $horseData->place = "pasture";
            $horseData->user_id = 0;
            $horseData->pasture_id = 0;
            $horseData->stall_id = 'none';
            $horseData->price = $price;
            $horseData->color = $color;
            $horseData->growth = $growth;
            $horseData->ground = $ground;
            $horseData->quality_leg = $quality_leg;

            $horseData->speed_b = $speed_b;
            $horseData->strength_b = $strength_b;
            $horseData->stamina_b = $stamina_b;
            $horseData->moment_b = $moment_b;
            $horseData->condition_b = $condition_b;
            $horseData->health_b = $health_b;

            $horseData->speed_w = $speed_w;
            $horseData->strength_w = $strength_w;
            $horseData->stamina_w = $stamina_w;
            $horseData->moment_w = $moment_w;
            $horseData->condition_w = $condition_w;
            $horseData->health_w = $health_w;
            $horseData->distance_min = $max_distance;
            $horseData->distance_max = $min_distance;
            $horseData->hidden = $value['hidden'];
            $horseData->triple_crown = $value['triple_crown'];
            $horseData->sys = $value['sys'];
            $horseData->f_sys = $value['f_sys'];
            $horseData->f_name = $value['f_name'];
            $horseData->f_factor = $value['f_factor'];
            $horseData->m_sys = $value['m_sys'];
            $horseData->m_name = $value['m_name'];
            $horseData->f_f_sys = $value['f_f_sys'];
            $horseData->f_f_name = $value['f_f_name'];
            $horseData->f_f_factor = $value['f_f_factor'];
            $horseData->f_m_sys = $value['f_m_sys'];
            $horseData->f_m_name = $value['f_m_name'];
            $horseData->m_f_sys = $value['m_f_sys'];
            $horseData->m_f_name = $value['m_f_name'];
            $horseData->m_f_factor = $value['m_f_factor'];
            $horseData->m_m_sys = $value['m_m_sys'];
            $horseData->m_m_name = $value['m_m_name'];

            $horseData->f_f_f_sys = $value['f_f_f_sys'];
            $horseData->f_f_f_name = $value['f_f_f_name'];
            $horseData->f_f_f_factor = $value['f_f_f_factor'];
            $horseData->f_f_m_sys = $value['f_f_m_sys'];
            $horseData->f_f_m_name = $value['f_f_m_name'];
            $horseData->f_m_f_sys = $value['f_m_f_sys'];
            $horseData->f_m_f_name = $value['f_m_f_name'];
            $horseData->f_m_f_factor = $value['f_m_f_factor'];
            $horseData->f_m_m_sys = $value['f_m_m_sys'];
            $horseData->f_m_m_name = $value['f_m_m_name'];

            $horseData->m_f_f_sys = $value['m_f_f_sys'];
            $horseData->m_f_f_name = $value['m_f_f_name'];
            $horseData->m_f_f_factor = $value['m_f_f_factor'];
            $horseData->m_f_m_sys = $value['m_f_m_sys'];
            $horseData->m_f_m_name = $value['m_f_m_name'];
            $horseData->m_m_f_sys = $value['m_m_f_sys'];
            $horseData->m_m_f_name = $value['m_m_f_name'];
            $horseData->m_m_f_factor = $value['m_m_f_factor'];
            $horseData->m_m_m_sys = $value['m_m_m_sys'];
            $horseData->m_m_m_name = $value['m_m_m_name'];
            $horseData->triple_crown = $value['triple_crown'];
            $horseData->sale_state = 1;
        }
        $horseData->save();

        $sale_horse = new SaleHorse();
        $sale_horse->horse_id = $horseData->id;
        $sale_horse->created_at = Carbon::now()->subDay();
        $sale_horse->save();

    }

    public function setColor()
    {
        $color_option = [
            '鹿毛' => 35,
            '黒鹿毛' => 30,
            '栗毛' => 20,
            '青鹿毛' => 5,
            '白毛' => 5,
        ];

        // setting color start
        $sel = rand(1, 95);

        foreach ($color_option as $option => $weight) {
            $sel -= $weight;
            // If the random number is less than or equal to zero, return the current option
            if ($sel <= 0) {
                return $option;
            }
        }
    }

    /**
     * set pattern
     */
    public function setPattern($age)
    {
        if ($age == "・0歳馬") {
            $options = [
                'D' => 76,
                'C' => 9,
                'B' => 7,
                'A' => 5,
                'S' => 3,
            ];
        } else if ($age == "・1歳馬") {
            $options = [
                'D' => 80,
                'C' => 8,
                'B' => 6,
                'A' => 4,
                'S' => 2,
            ];
        } else {
            $options = [
                'D' => 84,
                'C' => 7,
                'B' => 5,
                'A' => 3,
                'S' => 1,
            ];
        }

        $sel = rand(1, 100);

        foreach ($options as $option => $weight) {
            $sel -= $weight;
            // If the random number is less than or equal to zero, return the current option
            if ($sel <= 0) {
                return $option;
            }
        }
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $yesterdayStart = Carbon::yesterday()->startOfDay();
        $yesterdayEnd = Carbon::yesterday()->startOfDay()->addHours(12);
        $twoDaysAgoStart = Carbon::yesterday()->startOfDay()->addDays(-1)->addHours(12);
        $twoDaysAgoEnd = Carbon::yesterday()->startOfDay();

        // bad delete method //
        $sale_horse = SaleHorse::with('work_horses')->whereBetween('created_at', [$yesterdayStart, $yesterdayEnd])
            ->orWhereBetween('created_at', [$twoDaysAgoStart, $twoDaysAgoEnd])
            ->get();

        foreach ($sale_horse as $key => $value) {

            if ($value->work_horses->user_id != 0) {

                SaleHorse::with('work_horses')->whereBetween('created_at', [$yesterdayStart, $yesterdayEnd])
                ->orWhereBetween('created_at', [$twoDaysAgoStart, $twoDaysAgoEnd])
                ->delete();

            }else {

                Horse::find($value->horse_id)->delete();

            }

        }

        $zeroAgeHorse = SaleHorse::whereHas('work_horses', function ($query) {
            $query->where('age', '・0歳馬');
        })->get();

        $oneAgeHorse = SaleHorse::whereHas('work_horses', function ($query) {
            $query->where('age', '・1歳馬');
        })->get();

        $twoAgeHorse = SaleHorse::whereHas('work_horses', function ($query) {
            $query->where('age', '・2歳馬');
        })->get();

        $breedingHorse = SaleHorse::whereHas('work_horses', function ($query) {
            $query->where('type', '繁殖馬');
        })->get();

        $category = ['・0歳馬', '・1歳馬', '・2歳馬', '繁殖馬'];

        foreach ($category as $key => $value) {
            # code...
            if ($value == '繁殖馬') {
                # code...
                $this->saleHorseData = SaleHorse::whereHas('work_horses', function ($query) use ($value) {
                    $query->where('type', $value);
                })->get();
            }else{
                $this->saleHorseData = SaleHorse::whereHas('work_horses', function ($query) use ($value) {
                    $query->where('age', $value);
                })->get();
            }
            
            $numberData = count($this->saleHorseData);

            if ($numberData < 11) {
                for ($i=0; $i < 10 - $numberData; $i++) { 
                    $this->randomShow($value, $i);
                }
            }
        }

        $current_time = Carbon::now();

        $sale_horses = SaleHorse::with('highest_bidders')
        ->orderBy('created_at', 'desc')
        ->get();

        broadcast(new SaleHorsesEvent($sale_horses));
    }
}
