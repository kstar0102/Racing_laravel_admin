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
                Lineage::create([
                    "name" => $data['1'],
                    "price" => $data['2'],
                    "color" => $data['3'],
                    "growth" => $data['4'],
                    "ground" => $data['5'],
                    "quality_leg" => $data['6'],
                    "speed" => $data['7'],
                    "strength" => $data['8'],
                    "stamina" => $data['9'],
                    "moment" => $data['10'],
                    "condition" => $data['11'],
                    "health" => $data['12'],
                    "distance_min" => $data['13'],
                    "distance_max" => $data['14'],
                    "hidden" => "15",
                    "triple_crown" => "16",
                    "f_sys" => $data['17'],
                    "f_name" => $data['18'],
                    "f_factor" => $data['19'],
                    "m_sys" => $data['20'],
                    "m_name" => $data['21'],
                    "f_f_sys" => $data['22'],
                    "f_f_name" => $data['23'],
                    "f_f_factor" => $data['24'],
                    "f_m_sys" => $data['25'],
                    "f_m_name" => $data['26'],
                    "m_f_sys" => $data['27'],
                    "m_f_name" => $data['28'],
                    "m_f_factor" => $data['29'],
                    "m_m_sys" => $data['30'],
                    "m_m_name" => $data['31'],
                    "f_f_f_sys" => $data['32'],
                    "f_f_f_name" => $data['33'],
                    "f_f_f_factor" => $data['34'],
                    "f_f_m_sys" => $data['35'],
                    "f_f_m_name" => $data['36'],
                    "f_m_f_sys" => $data['37'],
                    "f_m_f_name" => $data['38'],
                    "f_m_f_factor" => $data['39'],
                    "f_m_m_sys" => $data['40'],
                    "f_m_m_name" => $data['41'],
                    "m_f_f_sys" => $data['42'],
                    "m_f_f_name" => $data['43'],
                    "m_f_f_factor" => $data['44'],
                    "m_f_m_sys" => $data['45'],
                    "m_f_m_name" => $data['46'],
                    "m_m_f_sys" => $data['47'],
                    "m_m_f_name" => $data['48'],
                    "m_m_f_factor" => $data['49'],
                    "m_m_m_sys" => $data['50'],
                    "m_m_m_name" => $data['51']
                ]);    
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
