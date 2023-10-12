<?php

namespace App\Http\Controllers;

use App\Helpers\ImageFileHelper;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Atlet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        // ImageFileHelper::instance()->delete($user->user_gambar);

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
}
