<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Http\Requests\StoreAbsenRequest;
use App\Http\Requests\UpdateAbsenRequest;
use App\Models\Atlet;
use App\Models\Jadwal;
use App\Models\JadwalIsi;
use App\Models\Pertemuan;
use Carbon\Carbon;
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
            return view('admin-pelatih.absen', compact('pertemuans'));
        }

        $jadwals = jadwal::where('user_id', auth()->user()->id)->get();

        $datas = [];
        foreach ($jadwals as $jadwal) {
            $pertemuans = [];
            foreach ($jadwal->pertemuan as $pertemuan) {
                $absens = [];
                foreach ($pertemuan->absen as $absen) {
                    $absens[] =
                        [
                            'id' => $absen->id
                        ];
                }
                $pertemuans[] =
                    [
                        'id' => $pertemuan->id,
                        'pertemuan_nama' => $pertemuan->pertemuan_nama,
                        'pertemuan_mulai' => $pertemuan->pertemuan_mulai,
                        'pertemuan_selesai' => $pertemuan->pertemuan_selesai,
                        'pertemuan_materi' => $absens
                    ];
            }
            $datas[] =
                [
                    'jadwal_id' => $jadwal->id,
                    'jadwal_nama' => $jadwal->jadwal_nama,
                    'pertemuan' => $pertemuans

                ];
        }
        // return response()->json($datas);
        return view('admin-pelatih.absen', compact('datas'));
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
        // dd($request->all());
        // menghitung jumlah atlet yang di check dan jumlah atlet yang ada di table absen
        $jml_check = count($request->all()) - 2;
        $jml_absen_pertemuan = Absen::where('pertemuan_id', $request->pertemuan_id)->count();
        $atlet = Atlet::where('atlet_status', 'Aktif')->count();

        if ($jml_check === $jml_absen_pertemuan) {
            for ($i = 0; $i < $atlet; $i++) {
                $pilih = 'pilih' . $i;
                if ($request->$pilih !== null) {
                    $absen_waktu = Absen::where('id', $request->$pilih)->first();
                    if ($absen_waktu->absen_waktu === null) {
                        Absen::where('id', $request->$pilih)
                            ->update([
                                'absen_waktu' => now()
                            ]);
                    }
                }
            }
        } elseif ($jml_check < $jml_absen_pertemuan) {
            $pertemuan_atlets = Absen::where('pertemuan_id', $request->pertemuan_id)->get();
            $no = 0;
            $id_pertemuan_atlet = [];
            foreach ($pertemuan_atlets as $pertemuan_atlet) {
                $pilih = 'pilih' . $no;
                $id_pertemuan_atlet[] = ['id_pertemuan_atlet' => $pertemuan_atlet->id];
                $id_check[] = ['id_check' => $request->$pilih];
                $no++;
            }
            for ($i = 0; $i < count($id_pertemuan_atlet); $i++) {
                if ($id_pertemuan_atlet[$i]['id_pertemuan_atlet'] != $id_check[$i]['id_check']) {
                    Absen::where('id', $id_pertemuan_atlet[$i]['id_pertemuan_atlet'])
                        ->update([
                            'absen_waktu' => null
                        ]);
                }
            }
        }

        toast('Berhasil mengubah data', 'success');
        return redirect()->back();
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

        return view('admin-pelatih.absen_detail', compact('datas', 'pertemuan'));
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

    public function input_absen($absen)
    {
        Absen::where('atlet_id', auth()->user()->id)
            ->where('id', $absen)
            ->update([
                'absen_waktu' => date("Y-m-d H:i:s")
            ]);

        toast("Berhasil absen", 'success');
        return redirect('/atlet/absensi');
    }

    public function input_absen_jadwal($absen)
    {
        Absen::where('atlet_id', auth()->user()->id)
            ->where('id', $absen)
            ->update([
                'absen_waktu' => date("Y-m-d H:i:s")
            ]);

        toast("Berhasil absen", 'success');
        return redirect()->back();
    }

    public function absen_detail($pertemuan)
    {
        $absen = Absen::where('atlet_id', auth()->user()->id)
            ->where('pertemuan_id', $pertemuan)
            ->first();

        $pertemuan = Pertemuan::where('id', $absen->pertemuan_id)->first();

        $absens = Absen::whereNotNull('absen_waktu')
            ->where('pertemuan_id', $pertemuan->id)
            ->get();

        return view(
            'atlet.absen_detail',
            compact(
                'absen',
                'absens',
            )
        );
    }
}
