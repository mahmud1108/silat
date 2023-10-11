<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $user = auth()->user();

        // if (
        //     auth()->check() &&
        //     in_array($user->role, ['admin', 'pelatih']) &&
        //     $user->user_status === 'aktif'
        // )
        if (auth()->check() && auth()->user()->role === 'admin' && auth()->user()->user_status === 'aktif'  || auth()->check() && auth()->user()->role === 'pelatih' && auth()->user()->user_status === 'aktif') {
            return $next($request);
        }

        return redirect()->route('login-admin');
    }
}
