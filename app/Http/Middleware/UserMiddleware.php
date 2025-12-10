<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // 2. Cek apakah user memiliki role user/pembeli
        $user = Auth::user();
        if ($user->role !== 'user') {
            // Jika bukan pembeli, redirect ke dashboard admin
            return redirect()->route('admin.dashboard')
                ->with('error', 'Akses ditolak. Halaman ini hanya untuk pembeli.');
        }

        // 3. Jika semua kondisi terpenuhi, lanjutkan request
        return $next($request);
    }
}