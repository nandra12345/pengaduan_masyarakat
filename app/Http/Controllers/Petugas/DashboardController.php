<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $petugas = Auth::guard('petugas')->user();

        // Statistik global semua pengaduan
        $stats = [
            'total'   => Pengaduan::count(),
            'pending' => Pengaduan::where('status', '0')->count(),
            'proses'  => Pengaduan::where('status', 'proses')->count(),
            'selesai' => Pengaduan::where('status', 'selesai')->count(),
        ];

        // 5 pengaduan terbaru yang masuk
        $pengaduanTerbaru = Pengaduan::with('masyarakat')
            ->latest()
            ->take(5)
            ->get();

        return view('petugas.dashboard', compact('petugas', 'stats', 'pengaduanTerbaru'));
    }
}