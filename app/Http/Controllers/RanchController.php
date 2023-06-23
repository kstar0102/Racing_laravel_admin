<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ranch;
use App\Models\User;
class RanchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Ranch::all();
        return view('admin.content.ranch', ['ranchs' => $data]);
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
        $ranch_id = $data['ranch_id'];
        $price = $data['price'];
        $user_id = $data['user_id'];
        $level = $data['level'];
        $pasture_name = $data['pasture_name'];
        $user_level = $data['user_level'];
         
        $user = User::where('id', $data['user_id'])->get();
        
         if($ranch_id != 0){
            if($level == 2){
                if($user_level >= "50"){
                    Ranch::where('id', $ranch_id)->update(['etc' => \DB::raw('etc + 1')]);
                    $data = Ranch::where('id', $ranch_id)->get();
                    User::where('id', $user_id)->update(['user_pt' => \DB::raw('user_pt -'.$price)]);
                    return response()->json(['data' => $data, 'user' => $user]);
                }
                else{
                    return response()->json(['message' => 'lacked user level']);
                }
            }
            else if($level == 3){
                if($user_level >= "100"){
                    Ranch::where('id', $ranch_id)->update(['etc' => \DB::raw('etc + 1')]);
                    $data = Ranch::where('id', $ranch_id)->get();
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
                $ranch = new Ranch();
                $ranch->pasture_name = $pasture_name;
                $ranch->level = 1;
                $ranch->price = 1000;
                $ranch->user_id = $user_id; 
                $ranch->save();
                $data = $ranch;

                User::where('id', $user_id)->update(['user_pt' => \DB::raw('user_pt -'.$price)]);
                return response()->json(['data' => $data, 'user' => $user]);
            }
            else{
                return response()->json(['message' => 'lacked user level']);
            }
         }
         return response()->json(['message' => 'success']);
    }
}
