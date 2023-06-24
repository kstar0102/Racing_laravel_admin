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
    public function getAll()
    {
        $today = Carbon::today();
        $first_day_of_month = Carbon::now()->startOfMonth();
        $week_order_today = ceil(($today->dayOfWeek + $today->day - $first_day_of_month->dayOfWeek) / 7);
        $month = $today->month;

        // Query race plans for the current month and week order
        $this_week_data = RacePlan::where('weeks', $month . "-" . $week_order_today)->get();
        // last week
        $last_week_number = Carbon::now()->subWeek()->weekOfMonth;
        $last_week_month = Carbon::now()->subWeek()->format('n');
        $last_week_data = RacePlan::where('weeks', $last_week_month . "-" . $last_week_number)->get();

        // before last week
        $before_last_week_number = Carbon::now()->subWeek()->subWeek()->weekOfMonth;
        $before_last_week_month = Carbon::now()->subWeek()->subWeek()->format('n');
        $before_last_week_data = RacePlan::where('weeks', $before_last_week_month . "-" . $before_last_week_number)->get();

        // next week
        $next_week_number = Carbon::now()->addWeek()->weekOfMonth;
        $next_week_month = Carbon::now()->addWeek()->format('n');
        $next_week_data = RacePlan::where('weeks', $next_week_month . "-" . $next_week_number)->get();

        // next next week
        $next_next_week_number = Carbon::now()->addWeek()->addWeek()->weekOfMonth;
        $next_next_week_month = Carbon::now()->addWeek()->addWeek()->format('n');
        $next_next_week_data = RacePlan::where('weeks', $next_next_week_month . "-" . $next_next_week_number)->get();
        return response()->json([
            'this_week_data' => $this_week_data,
            'last_week_data' => $last_week_data,
            'before_last_week_data' => $before_last_week_data,
            'next_week_data' => $next_week_data,
            'next_next_week_data' => $next_next_week_data
        ]);
    }
}