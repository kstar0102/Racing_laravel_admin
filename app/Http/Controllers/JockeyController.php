<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jockey;
use App\Models\User;
class JockeyController extends Controller
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
        $user_id = $inputData['user_id'];

        $model = new Jockey();
        $model->stall_id = $inputData['stall_id'];
        $model->name = $inputData['name'];
        $model->gender = $inputData['gender'];
        $model->user_id = $user_id;
        $model->age = 20;
        $model->prize = 0;
        $model->happy = 10;
        $model->tired = 0;
        $model->level = 0;
        $model->t1 = 0;
        $model->t2 = 0;
        $model->t3 = 0;
        $model->t4 = 0;
        $model->p_miss = 1;
        $model->p_target = 1;
        $model->p_difference = 1;
        $model->p_add = 1;
        $model->special = '';
        $model->save();

        User::where('id', $user_id)->update(['user_pt' => \DB::raw('user_pt - 5000')]);
        
        return response()->json(['message' => 'success']);
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
}
