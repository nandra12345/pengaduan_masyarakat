<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    /**
     * Daftar semua laporan milik masyarakat yang sedang login.
     */
    public function index()
    {
        $masyarakat = Auth::guard('masyarakat')->user();

        $pengaduans = $masyarakat->pengaduans()
            ->with('tanggapans.petugas')
            ->latest()
            ->paginate(10);

        return view('masyarakat.pengaduan.index', compact('pengaduans'));
    }

    /**
     * Form tulis laporan baru.
     */
    public function create()
    {
        return view('masyarakat.pengaduan.create');
    }

    /**
     * Simpan laporan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'isi_laporan' => ['required', 'string', 'min:20'],
            'foto'        => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ], [
            'isi_laporan.required' => 'Isi laporan wajib diisi.',
            'isi_laporan.min'      => 'Isi laporan minimal 20 karakter.',
            'foto.image'           => 'File harus berupa gambar.',
            'foto.mimes'           => 'Format foto harus JPG, JPEG, atau PNG.',
            'foto.max'             => 'Ukuran foto maksimal 2MB.',
        ]);

        $masyarakat = Auth::guard('masyarakat')->user();
        $fotoPath   = null;

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')
                ->store('pengaduan/foto', 'public');
        }

        Pengaduan::create([
            'tgl_pengaduan' => now()->toDateString(),
            'nik'           => $masyarakat->nik,
            'isi_laporan'   => $request->isi_laporan,
            'foto'          => $fotoPath,
            'status'        => '0',
        ]);

        return redirect()->route('masyarakat.pengaduan.index')
            ->with('success', 'Laporan berhasil dikirim! Kami akan segera memprosesnya.');
    }

    /**
     * Detail satu laporan beserta tanggapannya.
     */
    public function show(string $id)
    {
        $masyarakat = Auth::guard('masyarakat')->user();

        // Pastikan laporan ini milik masyarakat yang sedang login
        $pengaduan = $masyarakat->pengaduans()
            ->with('tanggapans.petugas')
            ->where('id_pengaduan', $id)
            ->firstOrFail();

        return view('masyarakat.pengaduan.show', compact('pengaduan'));
    }
}