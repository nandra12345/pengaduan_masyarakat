<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Halaman rekap laporan dengan filter tanggal (khusus Admin).
     */
    public function index(Request $request)
    {
        $query = Pengaduan::with(['masyarakat', 'tanggapans.petugas']);

        // Filter rentang tanggal
        if ($request->filled('dari')) {
            $query->whereDate('tgl_pengaduan', '>=', $request->dari);
        }
        if ($request->filled('sampai')) {
            $query->whereDate('tgl_pengaduan', '<=', $request->sampai);
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pengaduans = $query->latest()->get();

        // Statistik ringkasan untuk rekap
        $rekap = [
            'total'   => $pengaduans->count(),
            'pending' => $pengaduans->where('status', '0')->count(),
            'proses'  => $pengaduans->where('status', 'proses')->count(),
            'selesai' => $pengaduans->where('status', 'selesai')->count(),
        ];

        return view('admin.laporan.index', compact('pengaduans', 'rekap'));
    }

    /**
     * Halaman cetak/print rekap (tanpa header/footer nav).
     */
    public function cetak(Request $request)
    {
        $query = Pengaduan::with(['masyarakat', 'tanggapans.petugas']);

        if ($request->filled('dari')) {
            $query->whereDate('tgl_pengaduan', '>=', $request->dari);
        }
        if ($request->filled('sampai')) {
            $query->whereDate('tgl_pengaduan', '<=', $request->sampai);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pengaduans  = $query->latest()->get();
        $tanggalCetak = now()->isoFormat('D MMMM YYYY');

        $rekap = [
            'total'   => $pengaduans->count(),
            'pending' => $pengaduans->where('status', '0')->count(),
            'proses'  => $pengaduans->where('status', 'proses')->count(),
            'selesai' => $pengaduans->where('status', 'selesai')->count(),
        ];

        return view('admin.laporan.cetak', compact('pengaduans', 'rekap', 'tanggalCetak'));
    }
}