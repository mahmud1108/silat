<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Http\Requests\StoreJadwalRequest;
use App\Http\Requests\UpdateJadwalRequest;
use App\Models\Atlet;
use App\Models\JadwalIsi;
use App\Models\User;
use Carbon\Carbon;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $atlets = Atlet::where('atlet_status', 'Aktif')->get();
        $pelatihs = User::where('role', 'pelatih')->where('user_status', 'aktif')->get();
        $jadwals = Jadwal::all();
        return view('admin-pelatih.jadwal', compact('jadwals', 'pelatihs', 'atlets'));
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
    public function store(StoreJadwalRequest $request)
    {
        $jadwal = new Jadwal;
        $jadwal->jadwal_nama = $request->jadwal_nama;
        $jadwal->jadwal_waktu = $request->jadwal_waktu;
        $jadwal->user_id = $request->user_id;
        $jadwal->save();

        if (count($request->all()) > 5) {
            $users = Atlet::where('atlet_status', 'Aktif')->count();
            $jadwal_id = Jadwal::latest()->first();
            for ($i = 1; $i <= $users; $i++) {
                $pro = 'pilih' . $i;
                $user_id = $request->$pro;

                if ($user_id) {
                    $jadwalisi = new JadwalIsi;
                    $jadwalisi->jadwal_id = $jadwal_id->id;
                    $jadwalisi->atlet_id = $user_id;
                    $jadwalisi->save();
                }
            }
        }

        toast('Berhasil menambahkan data', 'success');
        return redirect()->route('jadwal.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJadwalRequest $request, $jadwal)
    {
        if ($request->user_id === null) {
            Jadwal::where('id', $jadwal)
                ->update([
                    'jadwal_nama' => $request->nama,
                    'jadwal_waktu' => $request->waktu,
                ]);
        } else {
            Jadwal::where('id', $jadwal)
                ->update([
                    'jadwal_nama' => $request->nama,
                    'jadwal_waktu' => $request->waktu,
                    'user_id' => $request->user_id
                ]);
        }

        toast('Berhasil merubah data', 'success');
        return redirect()->route('jadwal.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        toast('Berhasil menghapus jadwal', 'success');
        return redirect()->route('jadwal.index');
    }
}
