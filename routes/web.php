<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AtletController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CekRutinController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PertemuanController;
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
Route::view('/atlet', 'login-atlet')->name('login-atlet');

Route::post('/admin', [AuthController::class, 'login_admin']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout-admin');

route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('user', UserController::class)->only('index', 'store', 'update', 'destroy');
    route::post('/user/{user}', [UserController::class, 'role'])->name('user_role');

    Route::resource('jadwal', JadwalController::class)->only('index', 'store', 'update', 'destroy');
    Route::resource('pertemuan', PertemuanController::class)->only('index', 'store', 'update', 'destroy');
    Route::resource('absen', AbsenController::class)->only('index', 'store', 'update', 'destroy');
    Route::resource('materi', MateriController::class)->only('index', 'store', 'update', 'destroy');
    Route::resource('cek', CekRutinController::class)->only('index', 'store', 'update', 'destroy');
    Route::resource('pengumuman', PengumumanController::class)->only('index', 'store', 'update', 'destroy');
    Route::resource('atlet', AtletController::class)->only('index', 'store', 'update', 'destroy');
    Route::resource('user', UserController::class)->only('index', 'store', 'update', 'destroy');
});
