<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login_admin(Request $request)
    {
        $user = new User;
        $user->user_username = 'admin';
        $user->password  = Hash::make('admin');
        $user->user_gambar = 'gambar admin';
        $user->user_no_hp = '345345';
        $user->user_email = 'email';
        $user->user_alamat = 'alamat';
        $user->user_nama = 'user nama';
        $user->role = 'admin';
        $user->user_status = 'aktif';
        $user->save();

        $credentials = $request->validate([
            'user_username' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('dashboard-admin');
            }
        }

        return redirect()->route('login-admin');
    }
}
