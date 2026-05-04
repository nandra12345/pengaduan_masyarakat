<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Harus login sebagai petugas DAN level-nya harus 'admin'
        if (!Auth::guard('petugas')->check()) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        if (Auth::guard('petugas')->user()->level !== 'admin') {
            return redirect()->route('petugas.dashboard')
                ->with('error', 'Akses ditolak. Halaman ini khusus Administrator.');
        }

        return $next($request);
    }
}