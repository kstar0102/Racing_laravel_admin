<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PastureController;
use App\Http\Controllers\LineageController;
use App\Http\Controllers\HorseController;
use App\Http\Controllers\PoolController;
use App\Http\Controllers\SlopeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
| Admin Router
*/
// first login page
Route::get('/', function () {
    return view('login');
});

// dashboard page
Route::get('/dashboard', function () {
    return view('admin/content/dashboard');
})->name('dashboard');

// user page
Route::resource('resources', UserController::class)->names([
    'index' => 'user_index',
    'store' => 'login_action'
]);
Route::get('delete_user/{id}', [UserController::class, 'destroy']);

//pasture page
Route::resource('pasture', PastureController::class)->names([
    'index' => 'pasture_index',
]);
// lineage page
Route::resource('lineage', LineageController::class)->names([
    'index' => 'lineage_index',
]);
// horse page
Route::resource('horse', HorseController::class)->names([
    'index' =>'horse_index',
]);

Route::resource('pool', PoolController::class)->names([
    'index' => 'pool_index',
]);