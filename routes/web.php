<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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



Route::view('/admin', 'login-admin')->name('login-admin');
Route::view('/atlet', 'login-atlet')->name('login-pelatih');
Route::view('/pelatih', 'login-pelatih')->name('login-atlet');

Route::post('/admin', [AuthController::class, 'login_admin']);

Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard-admin');
});
