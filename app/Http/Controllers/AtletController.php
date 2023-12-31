<?php

namespace App\Http\Controllers;

use App\Helpers\ImageFileHelper;
use App\Http\Requests\ImportExcelAtletRequest;
use App\Models\Atlet;
use App\Http\Requests\StoreAtletRequest;
use App\Http\Requests\UpdateAtletRequest;
use App\Imports\AtletImport;
use App\Models\Kategori;
use App\Models\KelasUsia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

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
     * Import Excel.
     */
    public function import(ImportExcelAtletRequest $request)
    {

        // $file = ImageFileHelper::instance()->upload($request->import_excel, 'import');
        // dd(url($file));
        // dd($request->file('import_excel'));
        Excel::import(new AtletImport, $request->file('import_excel'));
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
    public function update(UpdateAtletRequest $request, $atlet)
    {
        Atlet::where('id', $atlet)
            ->update([
                'atlet_nama_lengkap' => $request->nama,
            ]);

        toast("Berhasil mengubah data", 'success');
        return redirect()->route('atlet.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Atlet $atlet)
    {
        ImageFileHelper::instance()->delete($atlet->atlet_foto);

        $atlet->delete();

        toast('Berhasil menghapus data', 'success');
        return redirect()->route('atlet.index');
    }
}
