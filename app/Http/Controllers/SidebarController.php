<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use Illuminate\Http\Request;

class SidebarController extends Controller
{
    public function jadwal()
    {
        return view('atlet.jadwal');
    }

    public function pertemuan()
    {
        return view('atlet.pertemuan');
    }

    public function absensi()
    {
        $absens = Absen::where('atlet_id', auth()->user()->id)->get();
        return view(
            'atlet.absensi',
            compact('absens')
        );
    }

    public function cek_rutin()
    {
        return view('atlet.cek_rutin');
    }

    public function pengumuman()
    {
        return view('atlet.pengumuman');
    }
}
