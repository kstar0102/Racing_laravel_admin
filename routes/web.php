<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PastureController;
use App\Http\Controllers\LineageController;
use App\Http\Controllers\HorseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});


Route::get('/dashboard', function () {
    return view('admin/content/dashboard');
})->name('dashboard');

Route::resource('resources', UserController::class)->names([
    'index' => 'user_index',
    'store' => 'login_action'
]);
Route::get('delete_user/{id}', [UserController::class, 'destroy']);
Route::resource('pasture', PastureController::class)->names([
    'index' => 'pasture_index',
]);
Route::resource('lineage', LineageController::class)->names([
    'index' => 'lineage_index',
]);

Route::resource('horse', HorseController::class)->names([
    'index' =>'horse_index',
]);

