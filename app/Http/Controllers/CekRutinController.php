<?php

namespace App\Http\Controllers;

use App\Models\CekRutin;
use App\Http\Requests\StoreCekRutinRequest;
use App\Http\Requests\UpdateCekRutinRequest;
use App\Models\Atlet;

class CekRutinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ceks = CekRutin::all();
        $atlets = Atlet::where('atlet_status', 'Aktif')->get();

        return view('admin-pelatih.cek', compact('ceks', 'atlets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function get_cek_data($atlet_id)
    {
        dd($atlet_id);
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
    public function store(StoreCekRutinRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CekRutin $cekRutin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CekRutin $cekRutin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCekRutinRequest $request, CekRutin $cekRutin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CekRutin $cekRutin)
    {
        //
    }
}
