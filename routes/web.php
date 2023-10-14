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
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SidebarController;
use App\Http\Controllers\UserController;
use App\Models\PertemuanMateri;
use App\Policies\CekRutinPolicy;
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
Route::view('/', 'login-atlet')->name('login-atlet');

Route::post('/admin', [AuthController::class, 'login_admin']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout-admin');
Route::post('/atlet_login', [AuthController::class, 'login_atlet'])->name('post_login_atlet');
Route::get('/logoutatlet', [AuthController::class, 'logout_atlet'])->name('logout_atlet');

route::middleware(['auth:atlet'])->prefix('/atlet')->group(function () {
    route::get('/dashboard', [DashboardController::class, 'atlet'])->name('dashboard_atlet');

    route::get('/profil', [ProfilController::class, 'profil_atlet'])->name('atlet_profil');
    route::post('/profil_atlet_save', [ProfilController::class, 'save_profil_atlet'])->name('save_profil_atlet');
    route::post('/update_foto_atlet', [ProfilController::class, 'update_foto_atlet'])->name('update_foto_atlet');

    Route::get('/jadwal', [SidebarController::class, 'jadwal']);
    Route::get('/pertemuan', [SidebarController::class, 'pertemuan']);
    Route::get('/absensi', [SidebarController::class, 'absensi']);
    Route::get('/cek_rutin', [SidebarController::class, 'cek_rutin']);
    Route::get('/pengumuman', [SidebarController::class, 'pengumuman']);

    route::get('/input_absen/{absen}', [AbsenController::class, 'input_absen'])->name('input_absen');
    route::get('/absen_detail/{pertemuan}', [AbsenController::class, 'absen_detail'])->name('absen_detail');
});

route::group(['middleware' => 'admin_pelatih'], function () {
    // Route::get('/tes', [MateriController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    route::get('/profil', [ProfilController::class, 'index'])->name('ubah_profil');
    route::post('/image_update', [ProfilController::class, 'image_update'])->name('image_update');
    route::post('/profil/{user}', [ProfilController::class, 'save'])->name('save_profil');

    Route::resource('user', UserController::class)->only('index', 'store', 'update', 'destroy', 'show');
    route::post('/user/{user}', [UserController::class, 'role'])->name('user_role');


    Route::resource('jadwal_isi', JadwalIsiController::class)->only('index', 'store', 'update', 'destroy', 'show');
    Route::resource('jadwal', JadwalController::class)->only('index', 'store', 'update', 'destroy');

    Route::resource('pertemuan', PertemuanController::class)->only('index', 'store', 'update', 'destroy', 'show');
    route::get('/pertemuan/detail/{pertemuan}', [PertemuanController::class, 'pertemuan_detail'])->name('pertemuan_detail');
    route::get('/pertemuan/create/{pertemuan}', [PertemuanController::class, 'create'])->name('pertemuan_create');
    route::get('/pertemuan_materi/delete/{pertemuan_materi}', [PertemuanController::class, 'del_pertemuan_materi'])->name('pertemuan_materi');

    Route::resource('absen', AbsenController::class)->only('index', 'store', 'update', 'destroy', 'show');
    Route::resource('materi', MateriController::class)->only('index', 'store', 'update', 'destroy');

    route::resource('galeri', GaleriController::class)->only('destroy', 'store');
    route::get('/galeri/download/{filename}', [GaleriController::class, 'download'])->name('download_materi');

    Route::resource('cek', CekRutinController::class)->only('index', 'store', 'update', 'destroy');
    route::get('/get_cek_rutin/{atlet_id}', [CekRutinController::class, 'get_cek_rutin'])->name('get_cek_rutin');

    Route::resource('pengumuman', PengumumanController::class)->only('index', 'store', 'update', 'destroy');
    Route::resource('user', UserController::class)->only('index', 'store', 'update', 'destroy');

    Route::resource('atlet', AtletController::class)->only('index', 'store', 'update', 'destroy');
    route::post('/import_atlet', [AtletController::class, 'import'])->name('import_atlet');
});
