<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Atlet;
use App\Models\CekRutin;
use App\Models\Jadwal;
use App\Models\JadwalIsi;
use App\Models\Pengumuman;
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

    public function atlet()
    {
        $absen = Absen::where('atlet_id', auth()->user()->id)->whereNull('absen_waktu')->orderBy('id', 'desc')->first();

        if ($absen != null) {
            $pertemuan = Pertemuan::where('id', $absen->pertemuan_id)->first();
        } else {
            $pertemuan = 'kosong';
        }

        $lastPengumuman = Pengumuman::latest()->first();
        $absen = Absen::where('atlet_id', auth()->user()->id)->count();
        $cek = CekRutin::where('atlet_id', auth()->user()->id)->count();
        $jadwal = JadwalIsi::where('atlet_id', auth()->user()->id)->count();

        return view(
            'atlet.dashboard',
            compact(
                'absen',
                'pertemuan',
                'jadwal',
                'absen',
                'cek',
                'lastPengumuman',
            )
        );
    }
}
