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
        $pertemuan = Pertemuan::where('id', $absen->pertemuan_id)->first();

        $cek_rutins = CekRutin::where('atlet_id', auth()->user()->id)->get();
        foreach ($cek_rutins as $cek_rutin) {
            $tinggi_badan[] = $cek_rutin->cr_tb;
            $berat_badan[] = $cek_rutin->cr_bb;
            $mental[] = $cek_rutin->cr_mental;
            $fisik[] = $cek_rutin->cr_fisik;
            $waktu[] = $cek_rutin->cr_waktu;
        }
        $tinggi_badan = json_encode($tinggi_badan);
        $berat_badan = json_encode($berat_badan);
        $mental = json_encode($mental);
        $fisik = json_encode($fisik);
        $waktu = json_encode($waktu);

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
                'tinggi_badan',
                'berat_badan',
                'mental',
                'fisik',
                'waktu'
            )
        );
    }
}
