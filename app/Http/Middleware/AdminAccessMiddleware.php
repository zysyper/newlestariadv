<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAccessMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah pengguna sudah login
        if (Auth::check()) {
            // Ambil user yang sedang login
            $user = Auth::user();

            // Periksa kondisi admin
            if ($user->name === 'admin' && $user->email === 'admin@gmail.com') {
                return $next($request);
            }

            // Redirect dengan pesan kesalahan
            return redirect()->route('home')->with('error', 'Anda Bukan Admin');
        }

        // Jika tidak login, arahkan ke halaman login
        return redirect()->route('login');
    }
}
