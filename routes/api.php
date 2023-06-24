<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PastureController;
use App\Http\Controllers\HorseController;
use App\Http\Controllers\PoolController;
use App\Http\Controllers\RacePlanController;
use App\Http\Controllers\RanchController;
use App\Http\Controllers\SlopeController;
use App\Http\Controllers\TruckController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// user handling
Route::post('/user', [UserController::class, 'login']);

Route::get('/randomTest', [HorseController::class, 'percentage']);

// after login in mobile app
Route::group(['middleware' => ['verifyJwt']], function () {
    // pasture handling
    Route::post('/pasture', [PastureController::class, 'store']);
    Route::post('/checkPastureName', [PastureController::class, 'checkName']);
    
    // lineage handling
    Route::get('/getlineage', [HorseController::class, 'getRandHorse']);
    
    // horse handling
    Route::post('/savehorse', [HorseController::class, 'store']);
    // when user arrived pasture page
    Route::get('/horse', [HorseController::class, 'show']);
    Route::post('/feedtrain', [HorseController::class, 'grow']);
    Route::post('/improvetrain', [HorseController::class, 'improve']);

    // when level up buildings
    Route::post('/leveluppasture', [PastureController::class, 'levelUp']);
    Route::post('/leveluppool', [PoolController::class, 'levelUp']);
    Route::post('/levelupranch', [RanchController::class, 'levelUp']);
    Route::post('/levelupslope', [SlopeController::class, 'levelUp']);
    Route::post('/leveluptruck', [TruckController::class, 'levelUp']);

    // get User every mounting
    Route::post('/getuser', [UserController::class, 'getUser']);

    // get all building data
    Route::post('/getbuildingdata', [PastureController::class, 'getBuildingData']);

    // get all race's plan
    Route::get('/getraceplan', [RacePlanController::class, 'getAll']);
 });
