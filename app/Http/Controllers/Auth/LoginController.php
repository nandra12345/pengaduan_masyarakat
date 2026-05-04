<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan form login.
     */
    public function showForm()
    {
        // Jika sudah login, redirect ke dashboard masing-masing
        if (Auth::guard('masyarakat')->check()) {
            return redirect()->route('masyarakat.dashboard');
        }
        if (Auth::guard('petugas')->check()) {
            return redirect()->route('petugas.dashboard');
        }

        return view('auth.login');
    }

    /**
     * Proses login — cek ke dua tabel secara berurutan.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $credentials = $request->only('username', 'password');
        $remember    = $request->boolean('remember');

        // ── Coba guard PETUGAS lebih dulu (admin & petugas) ──────────────
        if (Auth::guard('petugas')->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->route('petugas.dashboard')
                ->with('success', 'Selamat datang, ' . Auth::guard('petugas')->user()->nama_petugas . '!');
        }

        // ── Coba guard MASYARAKAT ─────────────────────────────────────────
        if (Auth::guard('masyarakat')->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->route('masyarakat.dashboard')
                ->with('success', 'Selamat datang, ' . Auth::guard('masyarakat')->user()->nama . '!');
        }

        // ── Kedua guard gagal ─────────────────────────────────────────────
        return back()
            ->withInput($request->only('username'))
            ->with('error', 'Username atau password salah. Silakan coba lagi.');
    }

    /**
     * Proses logout — hapus semua sesi guard yang aktif.
     */
    public function logout(Request $request)
    {
        Auth::guard('masyarakat')->logout();
        Auth::guard('petugas')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Anda telah berhasil logout.');
    }
}