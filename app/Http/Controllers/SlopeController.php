<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Slope;

class SlopeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Slope::all();
        return view('admin.content.slope', ['slopes' => $data]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function levelUp(Request $request){
        $data = $request->input('data');
        $slope_id = $data['slope_id'];
        $price = $data['price'];
        $user_id = $data['user_id'];
        $level = $data['level'];
        $pasture_name = $data['pasture_name'];
        $user_level = $data['user_level'];
         
        $user = User::where('id', $data['user_id'])->get();
        
         if($slope_id != 0){
            if($level == 2){
                if($user_level >= 130){
                    Slope::where('id', $slope_id)->update(['level' => \DB::raw('level + 1'), 'price' => $price]);
                    $data = Slope::where('id', $slope_id)->get();
                    User::where('id', $user_id)->update(['user_pt' => \DB::raw('user_pt -'.$price)]);
                    return response()->json(['data' => $data, 'user' => $user]);
                }
                else{
                    return response()->json(['message' => '馬主Lvが足りていない']);
                }
            }
            else if($level == 350){
                if($user_level >= "100"){
                    Slope::where('id', $slope_id)->update(['level' => \DB::raw('level + 1'), 'price' => $price]);
                    $data = Slope::where('id', $slope_id)->get();
                    User::where('id', $user_id)->update(['user_pt' => \DB::raw('user_pt -'.$price)]);
                    return response()->json(['data' => $data, 'user' => $user]);
                }
                else{
                    return response()->json(['message' => '馬主Lvが足りていない']);
                }
            }
         }
         else{
            if($user_level >= 40){
                $slope = new Slope();
                $slope->pasture_name = $pasture_name;
                $slope->level = 1;
                $slope->price = 1000;
                $slope->user_id = $user_id; 
                $slope->save();
                $data = $slope;

                $slope_data = array();
                $slope_data[0] = $data;
                User::where('id', $user_id)->update(['user_pt' => \DB::raw('user_pt -'.$price)]);
                return response()->json(['data' => $slope_data, 'user' => $user]);
            }
            else{
                return response()->json(['message' => '馬主Lvが足りていない']);
            }
         }
         return response()->json(['message' => 'success']);
    }
}
