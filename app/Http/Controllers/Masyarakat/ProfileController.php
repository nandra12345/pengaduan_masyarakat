<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Halaman utama profil.
     */
    public function index()
    {
        $masyarakat = Auth::guard('masyarakat')->user();

        $stats = [
            'total'   => $masyarakat->pengaduans()->count(),
            'pending' => $masyarakat->pengaduans()->where('status', '0')->count(),
            'selesai' => $masyarakat->pengaduans()->where('status', 'selesai')->count(),
        ];

        // Tanggal pertama kali membuat laporan (sebagai proxy "aktif sejak")
        $laporanPertama = $masyarakat->pengaduans()
            ->oldest()
            ->first();

        return view('masyarakat.profile.index', compact(
            'masyarakat', 'stats', 'laporanPertama'
        ));
    }

    /**
     * Form edit profil (nama & telepon).
     */
    public function edit()
    {
        $masyarakat = Auth::guard('masyarakat')->user();
        return view('masyarakat.profile.edit', compact('masyarakat'));
    }

    /**
     * Simpan perubahan profil.
     */
    public function update(Request $request)
    {
        $masyarakat = Auth::guard('masyarakat')->user();

        $request->validate([
            'nama' => ['required', 'string', 'max:35'],
            'telp' => ['nullable', 'string', 'max:13',
                       'regex:/^[0-9+\-\s]+$/'],
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'nama.max'      => 'Nama maksimal 35 karakter.',
            'telp.max'      => 'Nomor telepon maksimal 13 karakter.',
            'telp.regex'    => 'Format nomor telepon tidak valid.',
        ]);

        $masyarakat->update([
            'nama' => $request->nama,
            'telp' => $request->telp,
        ]);

        return redirect()->route('masyarakat.profile.index')
            ->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Form ganti password.
     */
    public function editPassword()
    {
        return view('masyarakat.profile.password');
    }

    /**
     * Proses ganti password.
     */
    public function updatePassword(Request $request)
    {
        $masyarakat = Auth::guard('masyarakat')->user();

        $request->validate([
            'password_lama'         => ['required', 'string'],
            'password'              => ['required', 'confirmed',
                                        Password::min(6)],
            'password_confirmation' => ['required'],
        ], [
            'password_lama.required' => 'Password lama wajib diisi.',
            'password.required'      => 'Password baru wajib diisi.',
            'password.confirmed'     => 'Konfirmasi password tidak cocok.',
        ]);

        // Verifikasi password lama
        if (!Hash::check($request->password_lama, $masyarakat->password)) {
            return back()
                ->withErrors(['password_lama' => 'Password lama tidak sesuai.'])
                ->withInput();
        }

        // Pastikan password baru berbeda
        if (Hash::check($request->password, $masyarakat->password)) {
            return back()
                ->withErrors(['password' =>
                    'Password baru tidak boleh sama dengan password lama.'])
                ->withInput();
        }

        $masyarakat->update([
            'password' => Hash::make($request->password),
        ]);

        // Logout setelah ganti password untuk keamanan
        Auth::guard('masyarakat')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success',
                'Password berhasil diubah. Silakan login kembali.');
    }
}