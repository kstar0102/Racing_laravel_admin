<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PastureController;

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

Route::post('/user', [UserController::class, 'login']);

Route::group(['middleware' => ['verifyJwt']], function () {
    Route::post('/pasture', [PastureController::class, 'store']);
    Route::post('/checkPastureName', [PastureController::class, 'checkName']);
 });
