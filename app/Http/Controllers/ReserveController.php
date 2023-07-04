<?php

namespace App\Http\Controllers;

use App\Models\ReserveFood;
use Illuminate\Http\Request;

class ReserveController extends Controller
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
        $foodNames = $inputData['food_name'];
        $horse_id = $inputData['horse_id'];
        $pasture_id = $inputData['pasture_id'];
        $user_id = $inputData['user_id'];
        $prices = $inputData['price'];
        $orders = $inputData['order'];
        $game_date = $inputData['game_date'];
    
        // Check if arrays have the same length
        $arraysLength = count($foodNames);
        if(count($prices) !== $arraysLength || count($orders) !== $arraysLength) {
            return response()->json(['message' =>  'Invalid input data']);
        }
    
        try {
            for ($i=0; $i < $arraysLength; $i++) { 
                $model = new ReserveFood();
                $model->horse_id = $horse_id;
                $model->pasture_id = $pasture_id;
                $model->food_name = $foodNames[$i];
                $model->user_id = $user_id;
                $model->game_date = $game_date;
                $model->price = $prices[$i];
                $model->order = $orders[$i];

                $model->save();
            }
        } catch (\Exception $e) {
            return response()->json(['message' =>  'Error occurred while saving data']);
        }

        $reserves = ReserveFood::where('game_date', $game_date)->where('pasture_id', $pasture_id)->get();
    
        return response()->json(['message' =>  'success', 'data' => $reserves]);
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
        $game_date = $inputData['game_date'];
        $pasture_id = $inputData['pasture_id'];

        $reserves = ReserveFood::where('game_date', $game_date)->where('pasture_id', $pasture_id)->get();

        return response()->json(['data' =>  $reserves]);
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
