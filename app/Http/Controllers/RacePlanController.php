<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\RacePlan;

class RacePlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = RacePlan::all();
        return view('admin.content.racePlan', ['races' => $data]);
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

    // get all race plans
    public function getAll(Request $request)
    {
        $inputData = $request->input('data');

        $this_month_week = $inputData['this_month_week'];
        $before_month_week = $inputData['before_month_week'];
        $before_before_month_week = $inputData['before_before_month_week'];
        $next_month_week = $inputData['next_month_week'];
        $next_next_month_week = $inputData['next_next_month_week'];
        $next_next_next_month_week = $inputData['next_next_next_month_week'];

        // Query race plans for the current month and week order
        $this_week_data = RacePlan::where('weeks', $this_month_week)->get();
        // last week
       
         $last_week_data = RacePlan::where('weeks', $before_month_week)->get();

        // before last week
        
        $before_last_week_data = RacePlan::where('weeks', $before_before_month_week)->get();

        // next week
        $next_week_data = RacePlan::where('weeks', $next_month_week)->get();

        // next next week

        $next_next_week_data = RacePlan::where('weeks', $next_next_month_week)->get();

        // next next next week 

        $next_next_next_week_data = RacePlan::where('weeks', $next_next_next_month_week)->get();
        
        return response()->json([
            'this_week_data' => $this_week_data,
            'last_week_data' => $last_week_data,
            'before_last_week_data' => $before_last_week_data,
            'next_week_data' => $next_week_data,
            'next_next_week_data' => $next_next_week_data,
            'next_next_next_week_data' => $next_next_next_week_data
        ]);
    }
}