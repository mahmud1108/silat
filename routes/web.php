<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AtletController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CekRutinController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JadwalDetailController;
use App\Http\Controllers\JadwalIsiController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PertemuanController;
use App\Http\Controllers\UserController;
use App\Models\PertemuanMateri;
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

route::group(['middleware' => 'admin_pelatih'], function () {
    // Route::get('/tes', [MateriController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('user', UserController::class)->only('index', 'store', 'update', 'destroy');
    route::post('/user/{user}', [UserController::class, 'role'])->name('user_role');

    Route::resource('jadwal_isi', JadwalIsiController::class)->only('index', 'store', 'update', 'destroy', 'show');
    Route::resource('jadwal', JadwalController::class)->only('index', 'store', 'update', 'destroy');

    Route::resource('pertemuan', PertemuanController::class)->only('index', 'store', 'update', 'destroy');
    route::get('/pertemuan/detail/{pertemuan}', [PertemuanController::class, 'pertemuan_detail'])->name('pertemuan_detail');
    route::get('/pertemuan/{pertemuan}', [PertemuanController::class, 'create'])->name('pertemuan_create');
    route::get('/pertemuan_materi/delete/{pertemuan_materi}', [PertemuanController::class, 'del_pertemuan_materi'])->name('pertemuan_materi');

    Route::resource('absen', AbsenController::class)->only('index', 'store', 'update', 'destroy');
    Route::resource('materi', MateriController::class)->only('index', 'store', 'update', 'destroy');

    route::resource('galeri', GaleriController::class)->only('destroy', 'store');
    route::get('/galeri/download/{filename}', [GaleriController::class, 'download'])->name('download_materi');

    Route::resource('cek', CekRutinController::class)->only('index', 'store', 'update', 'destroy');
    Route::resource('pengumuman', PengumumanController::class)->only('index', 'store', 'update', 'destroy');
    Route::resource('user', UserController::class)->only('index', 'store', 'update', 'destroy');

    Route::resource('atlet', AtletController::class)->only('index', 'store', 'update', 'destroy');
    route::post('/import_atlet', [AtletController::class, 'import'])->name('import_atlet');
});
