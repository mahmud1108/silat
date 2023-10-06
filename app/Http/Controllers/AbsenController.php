<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Http\Requests\StoreAbsenRequest;
use App\Http\Requests\UpdateAbsenRequest;
use App\Models\Atlet;
use App\Models\Jadwal;
use App\Models\JadwalIsi;
use App\Models\Pertemuan;
use PhpParser\Node\Stmt\Foreach_;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\DumpHandler;

class AbsenController extends Controller
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

        return view('admin-pelatih.absen', compact('pertemuans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAbsenRequest $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($absen)
    {
        $pertemuans = Pertemuan::where('id', $absen)->get();
        $absens = Absen::where('pertemuan_id', $absen)->get();

        // mendapatkan atlet yang ada di dalam suatu jadwal
        $pertemuan = Pertemuan::where('id', $absen)->first();
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
        return response()->json($datas);

        return view('admin-pelatih.absen_detail', compact('datas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absen $absen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAbsenRequest $request, Absen $absen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($absen)
    {
        Pertemuan::where('id', $absen)->delete();

        toast('Berhasil menghapus data', 'success');
        return redirect()->route('absen.index');
    }
}
