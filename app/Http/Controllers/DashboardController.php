<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Atlet;
use App\Models\Jadwal;
use App\Models\Pertemuan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::all()->count();
        $pertemuan = Pertemuan::all()->count();
        $atlet = Atlet::all()->count();
        return view('admin-pelatih.dashboard', compact('jadwal', 'pertemuan', 'atlet'));
    }
}
