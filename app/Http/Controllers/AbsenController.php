<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Http\Requests\StoreAbsenRequest;
use App\Http\Requests\UpdateAbsenRequest;
use App\Models\Atlet;
use App\Models\Jadwal;
use App\Models\Pertemuan;

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($absen)
    {
        $pertemuan = Pertemuan::where('id', $absen)->first();
        $pertemuans = Pertemuan::where('id', $absen)->get();
        $absens = Absen::where('pertemuan_id', $absen)->get();

        return view('admin-pelatih.absen_detail', compact('pertemuan', 'pertemuans', 'absens'));
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
