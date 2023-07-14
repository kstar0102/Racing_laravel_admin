<?php

namespace App\Http\Controllers;

use App\Models\Preset;
use Illuminate\Http\Request;

class PresetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputData = $request->input('data');
        $food_names = $inputData['food_name'];
        $food_types = $inputData['food_type'];
        $pasture_id = $inputData['pasture_id'];
        $user_id = $inputData['user_id'];
        $prices = $inputData['price'];
        $orders = $inputData['order'];
        $place = $inputData['place'];
        $preset_name = $inputData['preset_name'];
        $preset_num = $inputData['preset_num'];

        if ($place == 'pasture') {
            $stall_id = 'none';
        } else if ($place == 'stall') {
            $pasture_id = 'none';
        }
        $arraysLength = count($food_names);

            Preset::where('user_id', $user_id)->where('preset_num', $preset_num)->delete();

        try {
            for ($i = 0; $i < $arraysLength; $i++) {
                $model = new Preset();
                $model->name = $preset_name;
                $model->preset_num = $preset_num;
                $model->pasture_id = $pasture_id;
                $model->stall_id = $stall_id;
                $model->place = $place;
                $model->food_name = $food_names[$i];
                $model->food_type = $food_types[$i];
                $model->user_id = $user_id;
                $model->price = $prices[$i];
                $model->order = $orders[$i];
                $model->save();
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error occurred while saving data']);
        }
        $name_array = [];
        $data = Preset::where('user_id', $user_id)->get();
        
        foreach($data as $item){
            array_push($name_array, $item->name);
        }
        $unique_array = array_unique($name_array);
        return response()->json(['data' => $data, 'preset_names' => $unique_array]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $inputData = $request->input('data');
        $user_id = $inputData['user_id'];
        $name_array = [];
        $data = Preset::where('user_id', $user_id)->get();
        
        foreach($data as $item){
            array_push($name_array, $item->name);
        }
        $unique_array = array_unique($name_array);
        $sequentialArray = array_values($unique_array);
        return response()->json(['data' => $data, 'preset_names' => $sequentialArray]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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