<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Pool;
class PoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pool::all();
        return view('admin.content.pool', ['pools' => $data]);
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
    // start to level up function
    public function levelUp(Request $request){
        $data = $request->input('data');
        $pool_id = $data['pool_id'];
        $price = $data['price'];
        $user_id = $data['user_id'];
        $level = $data['level'];
        $pasture_name = $data['pasture_name'];
        $user_level = $data['user_level'];
         
        $user = User::where('id', $data['user_id'])->get();
         if($pool_id != 0){
            if($level == 2){
                if($user_level >= "50"){
                    Pool::where('id', $pool_id)->update(['etc' => \DB::raw('etc + 1')]);
                    $data = Pool::where('id', $pool_id)->get();
                    User::where('id', $user_id)->update(['user_pt' => \DB::raw('user_pt -'.$price)]);
                    return response()->json(['data' => $data, 'user' => $user]);
                }
                else{
                    return response()->json(['message' => 'lacked user level']);
                }
            }
            else if($level == 3){
                if($user_level >= "100"){
                    Pool::where('id', $pool_id)->update(['etc' => \DB::raw('etc + 1')]);
                    $data = Pool::where('id', $pool_id)->get();
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
                $pool = new Pool();
                $pool->pasture_name = $pasture_name;
                $pool->level = 1;
                $pool->price = 1000;
                $pool->user_id = $user_id; 
                $pool->save();
                $data = $pool;

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