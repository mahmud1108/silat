<?php

namespace App\Http\Controllers;

use App\Models\Atlet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login_admin(Request $request)
    {

        $creds = $request->validate(
            [
                'user_username' => ['required'],
                'password' => ['required'],
            ]
        );

        if (Auth::attempt($creds) === true) {
            toast('Berhasil login sebagai ' . auth()->user()->role, 'success');
            return redirect()->route('dashboard');
        }

        toast('Password tidak cocok atau akun tidak aktif');
        return redirect()->route('login-admin');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login-admin');
    }

    public function login_atlet(Request $request)
    {
        Atlet::where('id', 1)
            ->update([
                'atlet_email' => 'email@gmail.com',
                'password' => Hash::make('atlet')
            ]);
        // dd($request->all());
        $creds = $request->validate(
            [
                'atlet_email' => ['required'],
                'password' => ['required']
            ]
        );
        if (Auth::guard('atlet')->attempt($creds) === true) {
            toast('Berhasil login');
            return redirect()->route('dashboard_atlet');
        }

        toast('Email dan password tidak cocok');
        return redirect()->route('login-atlet');
    }

    public function logout_atlet()
    {
        Auth::logout();

        return redirect()->route('login-atlet');
    }
}
