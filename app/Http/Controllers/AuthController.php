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
        if (Auth::guard('admin')->attempt(['user_username' => $request->user_username, 'password' => $request->password])) {
            return redirect()->route('dashboard-admin');
        } elseif (Auth::guard('user')->attempt(['user_username' => $request->user_username, 'password' => $request->password])) {
            return redirect()->route('dashboard-pelatih');
        } else {
            return redirect()->back();
        }
    }
}
