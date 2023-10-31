<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lineage;

class lineageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lineage::truncate();
        $csvFile = fopen("work.csv", "r");
        $firstline = true;  
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                $hasValues = false;
                foreach ($data as $value) {
                    if ($value !== '') {
                        $hasValues = true;
                        break;
                    }
                }

                if ($hasValues) {
                    # code...
                    Lineage::create([
                        "name" => $data['0'],
                        "price" => $data['1'],
                        "color" => $data['2'],
                        "growth" => $data['3'],
                        "ground" => $data['4'],
                        "quality_leg" => $data['5'],
                        "speed" => $data['6'],
                        "strength" => $data['7'],
                        "stamina" => $data['8'],
                        "moment" => $data['9'],
                        "condition" => $data['10'],
                        "health" => $data['11'],
                        "distance_min" => $data['12'],
                        "distance_max" => $data['13'],
                        "hidden" => "15",
                        "triple_crown" => "16",
                        "sys" => $data['16'],
                        "f_name" => $data['17'],
                        "f_factor" => $data['18'],
                        "f_sys" => $data['19'],
                        "m_name" => $data['20'],
                        "m_sys" => $data['21'],
                        "f_f_name" => $data['22'],
                        "f_f_factor" => $data['23'],
                        "f_f_sys" => $data['24'],
                        "f_m_name" => $data['25'],
                        "f_m_sys" => $data['26'],
                        "m_f_name" => $data['27'],
                        "m_f_factor" => $data['28'],
                        "m_f_sys" => $data['29'],
                        "m_m_name" => $data['30'],
                        "m_m_sys" => $data['31'],
                        "f_f_f_name" => $data['32'],
                        "f_f_f_factor" => $data['33'],
                        "f_f_f_sys" => $data['34'],
                        "f_f_m_name" => $data['35'],
                        "f_f_m_sys" => $data['36'],
                        "f_m_f_name" => $data['37'],
                        "f_m_f_factor" => $data['38'],
                        "f_m_f_sys" => $data['39'],
                        "f_m_m_name" => $data['40'],
                        "f_m_m_sys" => $data['41'],
                        "m_f_f_name" => $data['42'],
                        "m_f_f_factor" => $data['43'],
                        "m_f_f_sys" => $data['44'],
                        "m_f_m_name" => $data['45'],
                        "m_f_m_sys" => $data['46'],
                        "m_m_f_name" => $data['47'],
                        "m_m_f_factor" => $data['48'],
                        "m_m_f_sys" => $data['49'],
                        "m_m_m_name" => $data['50'],
                        "m_m_m_sys" => $data['51'],
                    ]); 
                }
   
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
