<?php

namespace App\Http\Controllers;

use App\Helpers\ImageFileHelper;
use App\Models\Materi;
use App\Http\Requests\StoreMateriRequest;
use App\Http\Requests\UpdateMateriRequest;
use App\Models\Galeri;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $materis = Materi::all();
        } else {
            $materis = Materi::where('user_id', auth()->user()->id)->get();
        }
        return view('admin-pelatih.materi', compact('materis'));
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
    public function store(StoreMateriRequest $request)
    {
        // dd($request->all());
        $materi = new Materi;
        $materi->materi_nama = $request->nama;
        $materi->materi_deskripsi = $request->deskripsi;
        $materi->materi_status = $request->status;
        $materi->user_id = auth()->user()->id;
        $materi->save();

        $lastMateri = Materi::latest()->limit(1)->first();

        if (count($request->file) > 1) {
            $files = ImageFileHelper::instance()->multiFile($request->file, 'materi');
            foreach ($files as $file) {
                $galeri = new Galeri;
                $galeri->galeri_nama = $file;
                $galeri->materi_id = $lastMateri->id;
                $galeri->save();
            }
        } else {
            $file = ImageFileHelper::instance()->upload($request->file[0], 'materi');
            $galeri = new Galeri;
            $galeri->galeri_nama = $file;
            $galeri->materi_id = $lastMateri->id;
            $galeri->save();
        }

        toast('Berhasil menambahkan data', 'success');
        return redirect()->route('materi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Materi $materi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Materi $materi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMateriRequest $request, $materi)
    {
        Materi::where('id', $materi)
            ->update([
                'materi_nama' => $request->nama,
                'materi_status' => $request->status,
                'materi_deskripsi' => $request->deskripsi
            ]);

        toast('Berhasil merubah data', 'success');
        return redirect()->route('materi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Materi $materi)
    {
        $galeris = Galeri::where('materi_id', $materi->id)->get();
        if (count($galeris) > 1) {
            foreach ($galeris as $galeri) {
                ImageFileHelper::instance()->delete($galeri->geleri_nama);
                $galeri->delete();
            }
        }
        $materi->delete();

        toast('Berhasil menghapus data ', 'success');
        return redirect()->route('materi.index');
    }
}
