<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Truck;
class TruckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Truck::all();
        return view('admin.content.truck', ['trucks' => $data]);
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
        $truck_id = $data['truck_id'];
        $price = $data['price'];
        $user_id = $data['user_id'];
        $level = $data['level'];
        $pasture_name = $data['pasture_name'];
        $user_level = $data['user_level'];
         
        $user = User::where('id', $data['user_id'])->get();
        
         if($truck_id != 0){
            if($level == 2){
                if($user_level >= "50"){
                    Truck::where('id', $truck_id)->update(['level' => \DB::raw('level + 1'), 'price' => $price]);
                    $data = Truck::where('id', $truck_id)->get();
                    User::where('id', $user_id)->update(['user_pt' => \DB::raw('user_pt -'.$price)]);
                    return response()->json(['data' => $data, 'user' => $user]);
                }
                else{
                    return response()->json(['message' => 'lacked user level']);
                }
            }
            else if($level == 3){
                if($user_level >= "100"){
                    Truck::where('id', $truck_id)->update(['level' => \DB::raw('level + 1'), 'price' => $price]);
                    $data = Truck::where('id', $truck_id)->get();
                    User::where('id', $user_id)->update(['user_pt' => \DB::raw('user_pt -'.$price)]);
                    return response()->json(['data' => $data, 'user' => $user]);
                }
                else{
                    return response()->json(['message' => 'lacked user level']);
                }
            }
         }
         else{
            if($user_level >= 10){
                $truck = new Truck();
                $truck->pasture_name = $pasture_name;
                $truck->level = 1;
                $truck->price = 1000;
                $truck->user_id = $user_id; 
                $truck->save();
                $data = $truck;

                $truck_data = array();
                $truck_data[0] = $data;
                User::where('id', $user_id)->update(['user_pt' => \DB::raw('user_pt -'.$price)]);
                return response()->json(['data' => $truck_data, 'user' => $user]);
            }
            else{
                return response()->json(['message' => 'lacked user level']);
            }
         }
         return response()->json(['message' => 'success']);
    }
}
