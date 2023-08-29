<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CPU1;

class CpuHorseG1 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CPU1::truncate();
        $csvFile = fopen("cpuhorse1.csv", "r");
        $firstline = true;  
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                CPU1::create([
                    "name" => $data['1'],
                    "jockey_name" => $data['2'],
                    "gender" => $this->getFirstLetter($data['3'], 0),
                    "age" => $this->getFirstLetter($data['3'], 1),
                    "weight" => $data['4'],
                    "color" => $data['5'],
                    "need" => $this->checkNeed($data['6']),
                    "quality_leg" => $data['7'],
                    "speed" => $this->getRandomValue($data['8']),
                    "strength" => $this->getRandomValue($data['9']),
                    "stamina" => $this->getRandomValue($data['10']),
                    "moment" => $this->getRandomValue($data['11']),
                    "condition" => $this->getRandomValue($data['12']),
                    "health" => $this->getRandomValue($data['13']),
                    "distance_min" => 0,
                    "distance_max" => 0,
                    "baba" => "適性",
                    "ground" => "適性",
                    "happy" => $this->getNormalRand("happy"),
                    "tired" => $this->getNormalRand("tired"),
                    "game_name" => $data['18']
                ]);    
            }
            $firstline = false;
        }
        fclose($csvFile);
    }

    public function getFirstLetter($string, $num) 
    {
        return substr($string, $num, 1);
    }

    public function checkNeed($string)
    {
        $result = "";
        if($string == "◎")
        {
            $result = 1;
        }
        else
        {
            $result = 0;
        }
        return $result;
    }

    public function getRandomValue($string)
    {
        $result = 0;
        switch ($string) {
            case "S":
                $result = rand(400, 500);
                break;
            case "A":
                $result = rand(300, 400);
                break;
            case "B":
                $result = rand(200, 300);
                break;
            case "C":
                $result = rand(100, 200);
                break;
            case "D":
                $result = rand(0, 100);
                break;
            default:
                echo "It's an unknown fruit.";
        }
        return $result;
    }

    public function getNormalRand($string)
    {
        if($string == "happy")
        {
            return rand(5, 10);
        }
        else
        {
            return rand(5, 10);
        }
    }

}
