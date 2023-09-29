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
Route::view('/atlet', 'login-atlet')->name('login-pelatih');

Route::post('/admin', [AuthController::class, 'login_admin']);

Route::group(['middleware' => ['auth:admin', 'role:admin, pelatih'], 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('jadwal', JadwalController::class);
    Route::resource('pertemuan', PertemuanController::class);
    Route::resource('absen', AbsenController::class);
    Route::resource('materi', MateriController::class);
    Route::resource('cek', CekRutinController::class);
    Route::resource('pengumuman', PengumumanController::class);
    Route::resource('atlet', AtletController::class);
    Route::resource('user', UserController::class);
});
