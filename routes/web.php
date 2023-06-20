<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

