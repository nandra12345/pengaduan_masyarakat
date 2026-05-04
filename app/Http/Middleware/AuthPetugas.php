<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthPetugas
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('petugas')->check()) {
            return redirect()->route('login')
                ->with('error', 'Silakan login sebagai Petugas terlebih dahulu.');
        }

        return $next($request);
    }
}