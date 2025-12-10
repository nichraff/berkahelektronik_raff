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
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // 2. Cek apakah user memiliki role admin
        $user = Auth::user();
        if ($user->role !== 'admin') {
            // Jika bukan admin, redirect ke dashboard pembeli
            return redirect()->route('user.dashboard')
                ->with('error', 'Akses ditolak. Hanya admin yang boleh mengakses halaman ini.');
        }

        // 3. Jika semua kondisi terpenuhi, lanjutkan request
        return $next($request);
    }
}