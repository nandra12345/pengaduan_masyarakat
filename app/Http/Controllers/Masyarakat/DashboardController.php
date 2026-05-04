<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $masyarakat = Auth::guard('masyarakat')->user();

        // Statistik ringkasan untuk dashboard
        $stats = [
            'total'   => $masyarakat->pengaduans()->count(),
            'pending' => $masyarakat->pengaduans()->where('status', '0')->count(),
            'proses'  => $masyarakat->pengaduans()->where('status', 'proses')->count(),
            'selesai' => $masyarakat->pengaduans()->where('status', 'selesai')->count(),
        ];

        // 5 laporan terbaru
        $laporanTerbaru = $masyarakat->pengaduans()
            ->with('tanggapans.petugas')
            ->latest()
            ->take(5)
            ->get();

        return view('masyarakat.dashboard', compact('masyarakat', 'stats', 'laporanTerbaru'));
    }

    // 👇 INI ADALAH FUNGSI BARU UNTUK HALAMAN TENTANG KAMI 👇
    public function tentangKami()
    {
        // Mengarahkan ke file resources/views/masyarakat/tentang-kami/tentang-kami.blade.php
        return view('masyarakat.tentang-kami.tentang-kami');
    }
}