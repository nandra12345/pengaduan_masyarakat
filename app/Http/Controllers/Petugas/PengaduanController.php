<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    /**
     * Daftar semua pengaduan masuk (dengan filter & search).
     */
    public function index(Request $request)
    {
        $query = Pengaduan::with('masyarakat')->latest();

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search berdasarkan nama pelapor atau isi laporan
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('isi_laporan', 'like', "%{$search}%")
                  ->orWhereHas('masyarakat', function ($q2) use ($search) {
                      $q2->where('nama', 'like', "%{$search}%");
                  });
            });
        }

        $pengaduans = $query->paginate(10)->withQueryString();

        return view('petugas.pengaduan.index', compact('pengaduans'));
    }

    /**
     * Detail pengaduan + form tanggapan.
     */
    public function show(string $id)
    {
        $pengaduan = Pengaduan::with(['masyarakat', 'tanggapans.petugas'])
            ->findOrFail($id);

        return view('petugas.pengaduan.show', compact('pengaduan'));
    }

    /**
     * Simpan tanggapan dan update status pengaduan.
     */
    public function tanggapi(Request $request, string $id)
    {
        $request->validate([
            'tanggapan' => ['required', 'string', 'min:10'],
            'status'    => ['required', 'in:proses,selesai'],
        ], [
            'tanggapan.required' => 'Isi tanggapan wajib diisi.',
            'tanggapan.min'      => 'Tanggapan minimal 10 karakter.',
            'status.required'    => 'Status pengaduan wajib dipilih.',
            'status.in'          => 'Status tidak valid.',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $petugas   = Auth::guard('petugas')->user();

        // Simpan tanggapan baru
        Tanggapan::create([
            'id_pengaduan'  => $pengaduan->id_pengaduan,
            'tgl_tanggapan' => now()->toDateString(),
            'tanggapan'     => $request->tanggapan,
            'id_petugas'    => $petugas->id_petugas,
        ]);

        // Update status pengaduan
        $pengaduan->update(['status' => $request->status]);

        return redirect()->route('petugas.pengaduan.show', $id)
            ->with('success', 'Tanggapan berhasil disimpan dan status diperbarui.');
    }
}