<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /**
     * Tampilkan form registrasi masyarakat.
     */
    public function showForm()
    {
        return view('auth.register');
    }

    /**
     * Proses registrasi masyarakat baru.
     */
    public function register(Request $request)
    {
        $request->validate([
            'nik'      => [
                'required',
                'digits:16',
                'unique:masyarakat,nik',
            ],
            'nama'     => ['required', 'string', 'max:35'],
            'username' => [
                'required',
                'string',
                'min:4',
                'max:25',
                'unique:masyarakat,username',
                'regex:/^[a-zA-Z0-9_]+$/',
            ],
            'password' => ['required', 'confirmed', Password::min(6)],
            'telp'     => ['nullable', 'string', 'max:13'],
        ], [
            'nik.required'      => 'NIK wajib diisi.',
            'nik.digits'        => 'NIK harus terdiri dari 16 digit angka.',
            'nik.unique'        => 'NIK sudah terdaftar.',
            'nama.required'     => 'Nama lengkap wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique'   => 'Username sudah digunakan, coba yang lain.',
            'username.regex'    => 'Username hanya boleh huruf, angka, dan underscore.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed'=> 'Konfirmasi password tidak cocok.',
        ]);

        Masyarakat::create([
            'nik'      => $request->nik,
            'nama'     => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'telp'     => $request->telp,
        ]);

        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil! Silakan login.');
    }
}