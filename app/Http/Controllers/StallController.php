<?php

namespace App\Http\Controllers;

use App\Models\PoolStall;
use App\Models\RanchStall;
use App\Models\SlopeStall;
use App\Models\StallSp;
use App\Models\TruckStall;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Stall;

class StallController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = Stall::all();
        return response()->json(['data' => $data]);
    }

    public function showStallS(Request $request)
    {
        $inputData = $request->input('data');

        if (isset($inputData['user_id'])) {
            $data = StallSp::select('stall_s.id as sid', 'stall_s.level as slevel', 'stalls.*')
                ->join('stalls', 'stall_s.stall_id', '=', 'stalls.id')
                ->where('user_id', $inputData['user_id'])
                ->get();

            return response()->json(['data' => $data]);
        } else {
            return response()->json(['error' => 'Invalid input data'], 400);
        }
    }

    public function showStallState(Request $request)
    {
        $inputData = $request->input('data');
        $user_id = $inputData['user_id'];
        $stall_id = $inputData['stall_id'];

        $data = StallSp::where('user_id', $user_id)->where('stall_id', $stall_id)->get();
        return response()->json(['data' => $data]);
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

    public function getBuildingData(Request $request)
    {
        $data = $request->input('data');
        $user_id = $data['user_id'];
        $stall_id = $data['stall_id'];

        $pool = PoolStall::where('user_id', $user_id)->where('stall_id', $stall_id)->get();
        $ranch = RanchStall::where('user_id', $user_id)->where('stall_id', $stall_id)->get();
        $slope = SlopeStall::where('user_id', $user_id)->where('stall_id', $stall_id)->get();
        $truck = TruckStall::where('user_id', $user_id)->where('stall_id', $stall_id)->get();
        $stall = StallSp::where('user_id', $user_id)->get();

        return response()->json(['pool' => $pool, 'ranch' => $ranch, 'slope' => $slope, 'truck' => $truck, 'stall' => $stall]);
    }

    public function levelUp(Request $request)
    {
        $data = $request->input('data');
        $stall_id = $data['stall_id'];
        $price = $data['price'];
        $user_id = $data['user_id'];
        $level = $data['level'];
        $user_level = $data['user_level'];

        $handle = StallSp::where('id', $stall_id)->get();
        $user = User::where('id', $data['user_id'])->get();

        $outPutdata = [];
        if ($handle) {
            if ($level == 2) {
                if ($user_level >= "50") {
                    StallSp::where('id', $stall_id)->update(['level' => \DB::raw('level + 1')]);

                    $outPutdata = StallSp::where('id', $stall_id)->get();

                    User::where('id', $user_id)->update(['user_pt' => \DB::raw('user_pt -' . $price)]);
                    return response()->json(['data' => $outPutdata, 'user' => $user]);
                } else {
                    return response()->json(['message' => '厩舎Lvが足りていません。']);
                }
            } else if ($level == 3) {
                if ($user_level >= "100") {
                    StallSp::where('id', $stall_id)->update(['level' => \DB::raw('level + 1')]);

                    $outPutdata = StallSp::where('id', $stall_id)->get();

                    User::where('id', $user_id)->update(['user_pt' => \DB::raw('user_pt -' . $price)]);
                    return response()->json(['data' => $outPutdata, 'user' => $user]);
                } else {
                    return response()->json(['message' => '厩舎Lvが足りていません。']);
                }
            }
        }

        User::where('id', $user_id)->update(['user_pt' => \DB::raw('user_pt -' . $price)]);

        return response()->json(['data' => $outPutdata, 'user' => $user]);
    }

}