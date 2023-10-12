<?php

namespace App\Http\Controllers;

use App\Helpers\ImageFileHelper;
use App\Http\Requests\UpdateProfilAtletRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Atlet;
use App\Models\Kategori;
use App\Models\KelasUsia;
use App\Models\User;
use Egulias\EmailValidator\Result\Reason\AtextAfterCFWS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Calculation\Internal\MakeMatrix;

class ProfilController extends Controller
{
    public function index()
    {
        $user = User::where('id', auth()->user()->id)->first();

        return view('admin-pelatih.profil', compact('user'));
    }

    public function save(UpdateProfileRequest $request, $user)
    {
        User::where('id', auth()->user()->id)
            ->update([
                'user_nama' => $request->user_nama,
                'user_username' => $request->user_username,
                'user_no_hp' => $request->user_no_hp,
                'user_alamat' => $request->user_alamat,
                'user_email' => $request->user_email,
                'password' => Hash::make($request->password),
            ]);

        toast("Berhasil mengubah profil", 'success');
        return redirect()->back();
    }

    public function image_update(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();

        if (file_exists($user->user_gambar)) {
            ImageFileHelper::instance()->delete($user->user_gambar);
        }

        $request->validate([
            'update_gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $image = ImageFileHelper::instance()->upload($request->update_gambar, 'user_images');

        User::where('id', auth()->user()->id)
            ->update([
                'user_gambar' => $image
            ]);

        toast("Berhasil merubah foto profil", 'success');
        return redirect()->back();
    }

    public function profil_atlet()
    {
        $atlet = Atlet::where('id', auth()->user()->id)->first();
        $kategoris = Kategori::all();
        $kelas_usias = KelasUsia::all();

        return view('atlet.profil', compact('atlet', 'kategoris', 'kelas_usias'));
    }

    public function save_profil_atlet(UpdateProfilAtletRequest $request)
    {
        // dd($request->all());
        Atlet::where('id', auth()->user()->id)
            ->update([
                'atlet_nama_lengkap' => $request->atlet_nama,
                'atlet_email' => $request->atlet_email,
                'no_hp' => $request->no_hp,
                'atlet_tempat_lahir' => $request->tempat_lahir,
                'atlet_tanggal_lahir' => $request->tanggal_lahir,
                'atlet_jenis_kelamin' => $request->kelamin,
                'atlet_alamat' => $request->alamat,
                'atlet_keterangan' => $request->keterangan,
                'password' => Hash::make($request->password)
            ]);

        toast("Berhasil mengubah profil", 'success');
        return redirect()->back();
    }

    public function update_foto_atlet(Request $request)
    {
        $atlet = Atlet::where('id', auth()->user()->id)->first();

        if (file_exists($atlet->atlet_foto)) {
            ImageFileHelper::instance()->delete($atlet->atlet_foto);
        }

        $request->validate([
            'update_gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $image = ImageFileHelper::instance()->upload($request->update_gambar, 'atlet');

        Atlet::where('id', auth()->user()->id)
            ->update([
                'atlet_foto' => $image
            ]);

        toast("Berhasil merubah foto profil", 'success');
        return redirect()->back();
    }
}
