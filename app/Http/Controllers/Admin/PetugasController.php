<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PetugasController extends Controller
{
    public function index()
    {
        $petugasList = Petugas::latest()->paginate(10);
        return view('admin.petugas.index', compact('petugasList'));
    }

    public function create()
    {
        return view('admin.petugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_petugas' => ['required', 'string', 'max:35'],
            'username'     => [
                'required', 'string', 'max:25',
                'unique:petugas,username',
                'regex:/^[a-zA-Z0-9_]+$/',
            ],
            'password'     => ['required', 'confirmed', Password::min(6)],
            'telp'         => ['nullable', 'string', 'max:13'],
            'level'        => ['required', 'in:admin,petugas'],
        ]);

        Petugas::create([
            'nama_petugas' => $request->nama_petugas,
            'username'     => $request->username,
            'password'     => Hash::make($request->password),
            'telp'         => $request->telp,
            'level'        => $request->level,
        ]);

        return redirect()->route('admin.petugas.index')
            ->with('success', 'Akun petugas berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $petugas = Petugas::findOrFail($id);
        return view('admin.petugas.edit', compact('petugas'));
    }

    public function update(Request $request, string $id)
    {
        $petugas = Petugas::findOrFail($id);

        $request->validate([
            'nama_petugas' => ['required', 'string', 'max:35'],
            'username'     => [
                'required', 'string', 'max:25',
                'unique:petugas,username,' . $id . ',id_petugas',
                'regex:/^[a-zA-Z0-9_]+$/',
            ],
            'password'     => ['nullable', 'confirmed', Password::min(6)],
            'telp'         => ['nullable', 'string', 'max:13'],
            'level'        => ['required', 'in:admin,petugas'],
        ]);

        $data = [
            'nama_petugas' => $request->nama_petugas,
            'username'     => $request->username,
            'telp'         => $request->telp,
            'level'        => $request->level,
        ];

        // Hanya update password jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $petugas->update($data);

        return redirect()->route('admin.petugas.index')
            ->with('success', 'Data petugas berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $petugas = Petugas::findOrFail($id);

        // Cegah admin menghapus akunnya sendiri
        if (auth('petugas')->id() === (int) $id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $petugas->delete();

        return redirect()->route('admin.petugas.index')
            ->with('success', 'Akun petugas berhasil dihapus.');
    }
}