<?php

namespace App\Http\Controllers;

use App\Models\Pool;
use App\Models\Ranch;
use App\Models\Slope;
use App\Models\Truck;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Pasture;
use App\Http\Controllers\HorseController;

class PastureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pasture::all();
        return view('admin.content.pastures', ['pastures' => $data]);
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
        $pasture->etc = 1;

        if ($data['price'] == 500) {
            $pasture->volumn = 6;
        } else if ($data['price'] == 2000) {
            $pasture->volumn = 35;
        } else {
            $pasture->volumn = 70;
        }
        $pasture->horses = 0;
        User::where('id', $data['user_id'])->update(['user_pt' => \DB::raw('user_pt -' . $data['price'])]);
        $pasture->save();

        // start to register other buildings

        $horseController = app()->make(HorseController::class);

        $horseData = $horseController->requestRand();

        return response()->json(['horse' => $horseData, 'pasture' => $pasture]);
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
        if ($checkName) {
            return response()->json(['message' => 'noName']);
        } else if ($checkNameMean) {
            return response()->json(['message' => 'noNameMean']);
        } else {
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
    // start to level up
    public function levelUp(Request $request)
    {
        $data = $request->input('data');
        $pasture_id = $data['pasture_id'];
        $price = $data['price'];
        $user_id = $data['user_id'];
        $level = $data['level'];
        $user_level = $data['user_level'];

        $handle = Pasture::where('id', $pasture_id)->get();
        $user = User::where('id', $data['user_id'])->get();
        if ($handle) {
            if ($level == 2) {
                if ($user_level >= "50") {
                    Pasture::where('id', $pasture_id)->update(['etc' => \DB::raw('etc + 1')]);
                    $data = Pasture::where('id', $pasture_id)->get();
                    User::where('id', $user_id)->update(['user_pt' => \DB::raw('user_pt -' . $price)]);
                    return response()->json(['data' => $data, 'user' => $user]);
                } else {
                    return response()->json(['message' => '馬主Lvが足りていない']);
                }
            } else if ($level == 3) {
                if ($user_level >= "100") {
                    Pasture::where('id', $pasture_id)->update(['etc' => \DB::raw('etc + 1')]);
                    $data = Pasture::where('id', $pasture_id)->get();
                    User::where('id', $user_id)->update(['user_pt' => \DB::raw('user_pt -' . $price)]);
                    return response()->json(['data' => $data, 'user' => $user]);
                } else {
                    return response()->json(['message' => '馬主Lvが足りていない']);
                }
            }
        }

        User::where('id', $user_id)->update(['user_pt' => \DB::raw('user_pt -' . $price)]);

        return response()->json(['data' => $data, 'user' => $user]);
    }

    // get the all building data
    public function getBuildingData(Request $request)
    {
        $data = $request->input('data');
        $user_id = $data['user_id'];

        $pool = Pool::where('user_id', $user_id)->get();
        $ranch = Ranch::where('user_id', $user_id)->get();
        $slope = Slope::where('user_id', $user_id)->get();
        $truck = Truck::where('user_id', $user_id)->get();

        return response()->json(['pool' => $pool, 'ranch' => $ranch, 'slope' => $slope, 'truck' => $truck]);
    }
}