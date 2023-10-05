<?php

namespace App\Http\Controllers;

use App\Helpers\ImageFileHelper;
use App\Models\Galeri;
use App\Http\Requests\StoreGaleriRequest;
use App\Http\Requests\UpdateGaleriRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Exists;

class GaleriController extends Controller
{
    /**
     * Download file materi.
     */
    public function download($filename)
    {
        $disk = 'storage/materi/' . $filename;

        if (file_exists($disk)) {
            $path = 'storage/materi/';
            return response()->download($disk);
        }

        abort(404, 'File not found');
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
    public function store(StoreGaleriRequest $request)
    {
        if (count($request->file) > 1) {
            $files = ImageFileHelper::instance()->multiFile($request->file, 'materi');
            foreach ($files as $file) {
                $galeri = new Galeri;
                $galeri->galeri_nama = $file;
                $galeri->materi_id = $request->materi_id;
                $galeri->save();
            }
        } else {
            $file = ImageFileHelper::instance()->upload($request->file, 'materi');
            $galeri = new Galeri;
            $galeri->galeri_nama = $file;
            $galeri->materi_id = $request->materi_id;
            $galeri->save();
        }

        toast('Berhasil menambahkan materi baru', 'success');
        return redirect()->route('materi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Galeri $galeri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Galeri $galeri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGaleriRequest $request, Galeri $galeri)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Galeri $galeri)
    {
        ImageFileHelper::instance()->delete($galeri->galeri_nama);
        $galeri->delete();

        toast('Berhasil menghpus data', 'success');
        return redirect()->route('materi.index');
    }
}
