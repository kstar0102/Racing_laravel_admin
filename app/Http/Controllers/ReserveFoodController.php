<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\ReserveFoodJockey;
class ReserveFoodController extends Controller
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
    public function store(Request $request)
    {
        $inputData = $request->input('data');
        $jockey_id = $inputData['jockey_id'];
        $foodNames = $inputData['food_name'];
        $foodTypes = $inputData['food_type'];
        $user_id = $inputData['user_id'];
        $prices = $inputData['price'];
        $orders = $inputData['order'];
        $place = $inputData['place'];
        $game_date = $inputData['game_date'];
    
        // Check if arrays have the same length
        $arraysLength = count($foodNames);
        if(count($prices) !== $arraysLength || count($orders) !== $arraysLength) {
            return response()->json(['message' =>  'Invalid input data']);
        }

        $existingReserves = ReserveFoodJockey::where('jockey_id', $jockey_id)->get();

        if (!$existingReserves->isEmpty()) {
            ReserveFoodJockey::where('jockey_id', $jockey_id)->delete();
        }
    
        
            for ($i=0; $i < $arraysLength; $i++) { 
                $model = new ReserveFoodJockey();
                $model->jockey_id = $jockey_id;
                $model->food_name = $foodNames[$i];
                $model->user_id = $user_id;
                $model->place = $place;
                $model->food_type = $foodTypes[$i];
                $model->game_date = $game_date;
                $model->price = $prices[$i];
                $model->order = $orders[$i];
                $model->etc = '0';
                $model->save();
            }

        $reserves = ReserveFoodJockey::where('jockey_id', $jockey_id)->get();
    
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
        $jockey_id = $inputData['jockey_id'];

        $reserves = ReserveFoodJockey::where('jockey_id', $jockey_id)->get();

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
