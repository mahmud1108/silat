<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login_admin(Request $request)
    {
        // $admin = new User();
        // $admin->user_username = 'pelatih';
        // $admin->user_nama = 'admin';
        // $admin->password = Hash::make('pelatih');
        // $admin->user_no_hp = '29384750';
        // $admin->user_gambar = 'gambar';
        // $admin->user_email = '34234';
        // $admin->user_alamat = 'asdfasd';
        // $admin->user_status = 'aktif';
        // $admin->role = 'pelatih';
        // $admin->save();

        $creds = $request->validate([
            'user_username' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($creds) === true) {
            toast('Berhasil login sebagai ' . auth()->user()->role, 'success');
            return redirect()->route('dashboard');
        }
        return redirect()->route('login-admin');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login-admin');
    }
}
