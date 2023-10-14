<?php

namespace App\Http\Controllers;

use App\Helpers\ImageFileHelper;
use App\Models\Pengumuman;
use App\Http\Requests\StorePengumumanRequest;
use App\Http\Requests\UpdatePengumumanRequest;
use App\Models\User;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (auth()->user()->role === 'admin') {
            $pengumumans = Pengumuman::all();
        } else {
            $pengumumans = Pengumuman::where('user_id', auth()->user()->id)->get();
        }
        return view('admin-pelatih.pengumuman', compact('pengumumans'));
    }


    public function download($filename)
    {
        $disk = 'storage/pengumuman/' . $filename;

        if (file_exists($disk)) {
            $path = 'storage/pengumuman/';
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
    public function store(StorePengumumanRequest $request)
    {
        if (!$request->file) {
            $peng = new Pengumuman;
            $peng->pengumuman_judul = $request->pengumuman_judul;
            $peng->pengumuman_isi = $request->pengumuman_isi;
            $peng->pengumuman_tanggal = $request->pengumuman_tanggal;
            $peng->user_id = auth()->user()->id;
            $peng->save();
        } else {
            $peng = new Pengumuman;
            $peng->pengumuman_judul = $request->pengumuman_judul;
            $peng->pengumuman_isi = $request->pengumuman_isi;
            $peng->pengumuman_tanggal = $request->pengumuman_tanggal;
            $peng->user_id = auth()->user()->id;
            $peng->file = ImageFileHelper::instance()->upload($request->file, 'pengumuman');
            $peng->save();
        }
        toast('Berhasil menambahkan data', 'success');
        return redirect()->route('pengumuman.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengumuman $pengumuman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengumuman $pengumuman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePengumumanRequest $request, $pengumuman)
    {
        $getPengumuman = Pengumuman::where('id', $pengumuman)->first();
        if (!$request->file) {
            Pengumuman::where('id', $pengumuman)
                ->update([
                    'pengumuman_judul' => $request->pengumuman_judul,
                    'pengumuman_isi' => $request->pengumuman_isi,
                    'pengumuman_tanggal' => $request->pengumuman_tanggal
                ]);
        } else if (!$getPengumuman->file) {
            Pengumuman::where('id', $pengumuman)
                ->update([
                    'pengumuman_judul' => $request->pengumuman_judul,
                    'pengumuman_isi' => $request->pengumuman_isi,
                    'pengumuman_tanggal' => $request->pengumuman_tanggal,
                    'file' => ImageFileHelper::instance()->upload($request->file, 'pengumuman'),
                ]);
        } else {
            ImageFileHelper::instance()->delete($pengumuman->file);
            Pengumuman::where('id', $pengumuman)
                ->update([
                    'pengumuman_judul' => $request->pengumuman_judul,
                    'pengumuman_isi' => $request->pengumuman_isi,
                    'pengumuman_tanggal' => $request->pengumuman_tanggal,
                    'file' => ImageFileHelper::instance()->upload($request->file, 'pengumuman'),
                ]);
        }
        toast('Berhasi merubah data', 'success');
        return redirect()->route('pengumuman.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengumuman $pengumuman)
    {
        if ($pengumuman->file) {
            ImageFileHelper::instance()->delete($pengumuman->file);
        }
        $pengumuman->delete();

        toast('Berhasil menghapus data', 'success');
        return redirect()->route('pengumuman.index');
    }
}
