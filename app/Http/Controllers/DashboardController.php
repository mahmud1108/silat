<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Atlet;
use App\Models\Jadwal;
use App\Models\JadwalIsi;
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
        $pertemuans = Pertemuan::all();

        // $datas = [];

        // foreach ($pertemuans as $pertemuan) {
        //     $jadwals = [];
        //     foreach ($pertemuan->jadwal as $jadwal) {
        //         $jadwal_isis = [];
        //         foreach ($jadwal->jadwal_isi as $jadwal_isi) {
        //             $jadwal_isis[] =
        //                 [
        //                     'id' => $jadwal_isi->id,
        //                     'atlet_id' => $jadwal_isi->atlet_id
        //                 ];
        //         }
        //         $jadwals[] =
        //             [
        //                 'id' => $jadwal->id,
        //                 'jadwal_nama' => $jadwal->jadwal_nama,
        //                 'jadwal_isi' => $jadwal_isis
        //             ];
        //     }
        //     $datas[] =
        //         [
        //             'id' => $pertemuan->id,
        //             'jadwal' => $pertemuan->jadwal
        //         ];
        // }

        // return response()->json($datas);

        $jadwal = JadwalIsi::where('atlet_id', auth()->user()->id)->count();
        return view('atlet.dashboard', compact('jadwal'));
    }
}
