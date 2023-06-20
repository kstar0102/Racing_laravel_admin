<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasture;

class PastureController extends Controller
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->input('data');
        
        $pasture = new Pasture;
        $pasture->name = $data['name'];
        $pasture->name_mean = $data['name_mean'];
        $pasture->price = $data['price'];
        $pasture->style = $data['style'];
        $pasture->user_id = $data['user_id'];
        $pasture->save();
        
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkName(Request $request)
    {
        $data = $request->input('data');
        $checkName = Pasture::where('name', $data['name'])->first();
        $checkNameMean = Pasture::where('name_mean', $data['name_mean'])->first();
        if($checkName){
            return response()->json(['message' => 'noName']);
        }
        else if($checkNameMean){
            return response()->json(['message' => 'noNameMean']);
        }
        else{
            return response()->json(['message' => 'success']);
        }
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
