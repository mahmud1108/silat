<?php

namespace App\Http\Controllers;

use App\Models\Pertemuan;
use App\Http\Requests\StorePertemuanRequest;
use App\Http\Requests\UpdatePertemuanRequest;
use App\Models\Absen;
use App\Models\Atlet;
use App\Models\Galeri;
use App\Models\Jadwal;
use App\Models\JadwalIsi;
use App\Models\Materi;
use App\Models\PertemuanMateri;

class PertemuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $pertemuans = Pertemuan::all();
        } else {
            $pertemuans = Jadwal::where('user_id', auth()->user()->id)->get();
        }

        return view('admin-pelatih.pertemuan', compact('pertemuans'));
    }

    /**
     * Membuat pertemuan melalui Jadwal page.
     */
    public function create($pertemuan)
    {
        $jadwal = Jadwal::where('id', $pertemuan)->first();
        $materis = Materi::all();
        return view('admin-pelatih.pertemuan_tambah', compact('jadwal', 'materis'));
    }

    /**
     * Membuat pertemuan melalui Jadwal page.
     */
    public function pertemuan_detail($pertemuan)
    {
        $atlets = Atlet::where('atlet_status', 'Aktif')->with('absen')->get();

        $pertemuans = Pertemuan::where('id', $pertemuan)->get();
        $absens = Absen::where('pertemuan_id', $pertemuan)->get();

        // mendapatkan atlet yang ada di dalam suatu jadwal
        $pertemuan = Pertemuan::where('id', $pertemuan)->first();
        $jadwals = Jadwal::where('id', $pertemuan->jadwal_id)->get();

        $datas = [];
        foreach ($jadwals as $jadwal) {
            $jadwal_isis = [];
            foreach ($jadwal->jadwal_isi as $jadwal_isi) {
                $atlets = Atlet::where('id', $jadwal_isi->atlet_id)->get();
                foreach ($atlets as $atlet) {
                    $absens = [];
                    foreach ($atlet->absen as $absen) {
                        $absens[] =
                            [
                                'id_absen' => $absen->id,
                                'atlet_id' => $absen->atlet_id,
                                'pertemuan_id' => $absen->pertemuan_id
                            ];
                    }
                }
                $jadwal_isis[] =
                    [
                        'id' => $jadwal_isi->id,
                        'jadwal_id' => $jadwal_isi->jadwal_id,
                        'atlet_id' => $jadwal_isi->atlet_id,
                        'atlet' => $atlets,
                    ];
            }
            $datas[] =
                [
                    'jadwal_id' => $jadwal->id,
                    'jadwal_isi' => $jadwal_isis,
                ];
        }

        $pertemuan_materis = PertemuanMateri::where('pertemuan_id', $pertemuan->id)->with('materi')->first();
        $galeris = Galeri::where('materi_id', $pertemuan_materis['materi']['id'])->get();

        $galeri_nama = [];
        foreach ($galeris as $galeri) {
            $path = $galeri->galeri_nama;
            $pathParts = explode('/', $path);
            $lastWord = end($pathParts);

            $galeri_nama[] =
                [
                    'galeri_nama' => $lastWord
                ];
        }

        return view('admin-pelatih.pertemuan_detail', compact('pertemuan', 'atlets', 'datas', 'galeri_nama'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePertemuanRequest $request)
    {
        $pertemuan = new Pertemuan;
        $pertemuan->pertemuan_nama = $request->nama_pertemuan;
        $pertemuan->pertemuan_deskripsi = $request->deskripsi;
        $pertemuan->pertemuan_mulai = $request->mulai;
        $pertemuan->pertemuan_selesai = $request->selesai;
        $pertemuan->jadwal_id = $request->jadwal_id;
        $pertemuan->save();

        $getLastPertemuan = Pertemuan::latest()->first();

        $jadwal_isis = JadwalIsi::where('jadwal_id', $request->jadwal_id)->get();
        foreach ($jadwal_isis as $jadwal_isi) {
            $absen = new Absen;
            $absen->absen_waktu = null;
            $absen->atlet_id = $jadwal_isi->atlet_id;
            $absen->pertemuan_id = $getLastPertemuan->id;
            $absen->save();
        }

        if (count($request->all()) > 8) {
            $materis = Materi::where('materi_status', 'aktif')->count();
            for ($i = 1; $i <= $materis; $i++) {
                $pilih = 'pilih' . $i;
                $pertemuan_materi = new PertemuanMateri;
                $pertemuan_materi->pertemuan_id = $getLastPertemuan->id;
                $pertemuan_materi->materi_id = $request->$pilih;
                $pertemuan_materi->save();
            }
        } else {
            $pertemuan_materi = new PertemuanMateri;
            $pertemuan_materi->pertemuan_id = $getLastPertemuan->id;
            $pertemuan_materi->materi_id = $request->pilih1;
            $pertemuan_materi->save();
        }

        toast('Berhasil mengambahkan data', 'success');
        return redirect()->route('jadwal.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($pertemuan)
    {
        $pertemuans = Pertemuan::where('jadwal_id', $pertemuan)->get();
        $jadwal = Jadwal::where('id', $pertemuan)->first();

        return view('admin-pelatih.pertemuan_jadwal_detail', compact('pertemuans', 'jadwal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pertemuan $pertemuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePertemuanRequest $request, Pertemuan $pertemuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pertemuan $pertemuan)
    {
        $pertemuan->delete();

        toast('Berhasil menghapus data', 'success');
        return redirect()->route('pertemuan.index');
    }

    /**
     * Delete prtemuan materi dari pertemuan
     */
    public function del_pertemuan_materi(PertemuanMateri $pertemuan_materi)
    {
        $pertemuan_materi->delete();

        toast("Berhasil menghapus data", 'success');
        return redirect()->back();
    }
}
