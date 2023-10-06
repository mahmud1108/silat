<?php

namespace App\Http\Controllers;

use App\Models\JadwalIsi;
use App\Http\Requests\StoreJadwalIsiRequest;
use App\Http\Requests\UpdateJadwalIsiRequest;
use App\Models\Absen;
use App\Models\Atlet;
use App\Models\Jadwal;

class JadwalIsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreJadwalIsiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($jadwal)
    {
        $jadwal_details = JadwalIsi::where('jadwal_id', $jadwal)->with('jadwal', 'atlet')->get();
        $jadwal = Jadwal::where('id', $jadwal)->first();
        $atlets = Atlet::where('atlet_status', 'Aktif')->get();

        return view('admin-pelatih.jadwal_atlet_update', compact('jadwal', 'jadwal_details', 'atlets'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalIsi $jadwalIsi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJadwalIsiRequest $request,  $jadwalIsi)
    {
        $atlets = Atlet::where('atlet_status', 'Aktif')->count();
        for ($i = 1; $i <= $atlets; $i++) {
            $pilih = 'pilih' . $i;
            $atlet = 'atlet' . $i;
            if ($request->$pilih === $request->$atlet) {
                $jadwal_isi_atlet = JadwalIsi::where('atlet_id', $request->$pilih)->where('jadwal_id', $jadwalIsi)->first();
                if (!$jadwal_isi_atlet) {
                    $jadwal_isi2 = new JadwalIsi;
                    $jadwal_isi2->jadwal_id = $jadwalIsi;
                    $jadwal_isi2->atlet_id = $request->$pilih;
                    $jadwal_isi2->save();

                    $absen = new Absen;
                    $absen->absen_waktu = null;
                    $absen->atlet_id =  $request->$pilih;
                    $absen->pertemuan_id = ;
                    $absen->save();
                }
            } else {
                JadwalIsi::where('atlet_id', $request->$atlet)->where('jadwal_id', $jadwalIsi)->delete();
            }
        }

        toast('Berhasil merubah data', 'success');
        return redirect()->route('jadwal.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalIsi $jadwalIsi)
    {
        //
    }
}
