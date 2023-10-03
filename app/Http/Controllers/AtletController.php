<?php

namespace App\Http\Controllers;

use App\Helpers\ImageFileHelper;
use App\Models\Atlet;
use App\Http\Requests\StoreAtletRequest;
use App\Http\Requests\UpdateAtletRequest;
use App\Models\Kategori;
use App\Models\KelasUsia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AtletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $atlets = Atlet::all();
        $kategoris = Kategori::all();
        $usias = KelasUsia::all();

        return view('admin-pelatih.atlet', compact('usias', 'atlets', 'kategoris'));
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
    public function store(StoreAtletRequest $request)
    {
        $atlet = new Atlet;
        $atlet->atlet_nama_lengkap = $request->nama;
        $atlet->atlet_tempat_lahir = $request->tmpt_lahir;
        $atlet->atlet_tanggal_lahir = $request->tgl_lahir;
        $atlet->atlet_jenis_kelamin = $request->kelamin;
        $atlet->atlet_alamat = $request->alamat;
        $atlet->no_hp = $request->no_hp;
        $atlet->atlet_foto = ImageFileHelper::instance()->upload($request->atlet_gambar, 'atlet');
        $atlet->atlet_email = $request->atlet_email;
        $atlet->atlet_password = Hash::make($request->password);
        $atlet->atlet_status = $request->status;
        $atlet->atlet_keterangan = $request->keterangan;
        $atlet->kategori_id = $request->kategori;
        $atlet->kelas_usia_id = $request->kelas_usia;
        $atlet->save();

        toast('Berhasil menambahkan data', 'success');
        return redirect()->route('atlet.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(Atlet $atlet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Atlet $atlet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAtletRequest $request, Atlet $atlet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Atlet $atlet)
    {
        //
    }
}
