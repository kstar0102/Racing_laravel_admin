<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PastureController;
use App\Http\Controllers\LineageController;
use App\Http\Controllers\HorseController;


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

Route::group(['middleware' => ['verifyJwt']], function () {
    // pasture handling
    Route::post('/pasture', [PastureController::class, 'store']);
    Route::post('/checkPastureName', [PastureController::class, 'checkName']);
    
    // lineage handling
    Route::get('/getlineage', [HorseController::class, 'getRandHorse']);
    
    // horse handling
    Route::post('/horse', [HorseController::class, 'store']);
    // when user arrived pasture page
    Route::get('/horse', [HorseController::class, 'show']);
 });
