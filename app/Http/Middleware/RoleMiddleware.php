<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Fungsi ini yang akan mengeksekusi pengecekan akses
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Pastikan user sudah login terlebih dahulu
        if (!auth()->check()) {
            return redirect('/login');
        }

        // 2. Cek apakah role user saat ini cocok dengan role yang diizinkan masuk
        if (in_array(auth()->user()->role, $roles)) {
            // Jika cocok, silakan lanjutkan masuk ke halaman
            return $next($request);
        }

        // 3. Jika rolenya tidak diizinkan, kembalikan ke dashboard dengan pesan error
        return redirect()->route('dashboard')->with('error', 'Akses ditolak! Anda tidak memiliki izin untuk membuka halaman tersebut.');
    }
}
