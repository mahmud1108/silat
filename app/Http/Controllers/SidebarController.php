<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\CekRutin;
use Dotenv\Repository\RepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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


        $ceks = CekRutin::where('atlet_id', auth()->user()->id)->get();
        $nama = CekRutin::where('atlet_id', auth()->user()->id)->with('atlet')->first();

        $datas = [];
        foreach ($ceks as $cek) {

            $date = Carbon::parse($cek->cr_waktu);
            $dateFormat = $date->format('d F Y');

            if ($cek['cr_mental'] <= 50) {
                $cr_mental = "Kurang Baik";
            } elseif ($cek['cr_mental'] <= 70) {
                $cr_mental = "Baik";
            } elseif ($cek['cr_mental'] <= 100) {
                $cr_mental = "Baik Sekali";
            }

            if ($cek['cr_fisik'] <= 50) {
                $cr_fisik = "Kurang Baik";
            } elseif ($cek['cr_fisik'] <= 70) {
                $cr_fisik = "Baik";
            } elseif ($cek['cr_fisik'] <= 100) {
                $cr_fisik = "Baik Sekali";
            }

            $datas[] =
                [
                    'id' => $cek->id,
                    'cr_tb' => $cek->cr_tb,
                    'cr_bb' => $cek->cr_bb,
                    'cr_mental' => $cr_mental,
                    'cr_mentals' => $cek->cr_mental,
                    'cr_fisik' => $cr_fisik,
                    'cr_fisiks' => $cek->cr_fisik,
                    'cr_waktu' => $dateFormat,
                ];
        }

        return view('atlet.cek', compact('datas', 'nama'));
    }

    public function pengumuman()
    {
        return view('atlet.pengumuman');
    }
}
