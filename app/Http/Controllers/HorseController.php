<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horse;

class HorseController extends Controller
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
        $data = $request->input('data');
        $horse = new Horse;
        $horse->name = $data['name'];
        $horse->age = $data['age'];
        $horse->distance_max = $data['distance_max'];
        $horse->distance_min = $data['distance_min'];
        $horse->color = $data['color'];
        $horse->gender = $data['gender'];
        $horse->growth = $data['growth'];
        $horse->ground = $data['ground'];
        $horse->quality_leg = $data['quality_leg'];
        $horse->speed = $data['speed'];
        $horse->strength = $data['strength'];
        $horse->moment = $data['moment'];
        $horse->stamina = $data['stamina'];
        $horse->condition = $data['condition'];
        $horse->health = $data['health'];
        $horse->price = $data['price'];
        $horse->hidden = $data['hidden'];
        $horse->triple_crown = $data['triple_crown'];

        $horse->f_sys = $data['f_sys'];
        $horse->f_name = $data['f_name'];
        $horse->f_factor = $data['f_factor'];
        $horse->m_sys = $data['m_sys'];
        $horse->m_name = $data['m_name'];

        $horse->f_f_sys = $data['f_f_sys'];
        $horse->f_f_name = $data['f_f_name'];
        $horse->f_f_factor = $data['f_f_factor'];
        $horse->f_m_sys = $data['f_m_sys'];
        $horse->f_m_name = $data['f_m_name'];

        $horse->m_f_sys = $data['m_f_sys'];
        $horse->m_f_name = $data['m_f_name'];
        $horse->m_f_factor = $data['m_f_factor'];
        $horse->m_m_sys = $data['m_m_sys'];
        $horse->m_m_name = $data['m_m_name'];
        
        $horse->user_id = $data['user_id'];
        $horse->pasture_id = $data['pasture_id'];
        $horse->save();

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
