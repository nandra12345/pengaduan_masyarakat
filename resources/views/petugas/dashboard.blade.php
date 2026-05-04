@extends('layouts.app')
@section('title', 'Dashboard Petugas')

@section('content')
<div class="pb-28 bg-gray-50/50 min-h-screen">

    {{-- ═══════════════════════════════════════════════
         HERO SECTION (Dinamis: Admin = Amber, Petugas = Biru)
    ═══════════════════════════════════════════════ --}}
    <div class="relative px-5 pt-8 pb-16 overflow-hidden rounded-b-[2rem] shadow-sm
        {{ $petugas->isAdmin() 
            ? 'bg-gradient-to-br from-amber-600 via-amber-700 to-orange-900' 
            : 'bg-gradient-to-br from-blue-700 via-blue-800 to-indigo-900' }}">

        {{-- Dekorasi Latar Belakang (Glass Circles) --}}
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl pointer-events-none z-0"></div>
        <div class="absolute bottom-0 right-10 w-24 h-24 bg-white/5 rounded-full blur-xl pointer-events-none z-0"></div>

        <div class="relative z-10 flex items-start justify-between">
            <div class="w-full">
                <div class="flex items-center justify-between w-full mb-1">
                    <p class="text-white/80 text-[11px] font-bold tracking-widest uppercase drop-shadow-md">
                        Selamat Bertugas,
                    </p>
                    {{-- Role Badge Glassmorphism --}}
                    <span class="inline-flex items-center gap-1.5 text-[10px] px-2.5 py-1 rounded-full font-black uppercase tracking-wider backdrop-blur-md border shadow-sm
                        {{ $petugas->isAdmin() ? 'bg-white/20 text-white border-white/40' : 'bg-white/10 text-blue-100 border-white/20' }}">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        {{ $petugas->level }}
                    </span>
                </div>
                
                <h2 class="text-white text-2xl font-extrabold tracking-tight drop-shadow-md pr-12 line-clamp-2">
                    {{ $petugas->nama_petugas }}
                </h2>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════
         STATISTIK PENANGANAN (Floating, 2x2 Grid)
    ═══════════════════════════════════════════════ --}}
    <div class="px-5 -mt-8 relative z-20">
        <div class="grid grid-cols-2 gap-3">
            
            {{-- Menunggu Card (Prioritas Utama - Merah/Amber) --}}
            <div class="bg-white rounded-2xl p-4 shadow-[0_8px_30px_rgb(0,0,0,0.06)] border-2 border-red-100/80 flex flex-col gap-2 transition-transform active:scale-95">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center border border-red-100/50">
                        <svg class="w-5 h-5 text-red-500 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-3xl font-black text-red-600 leading-none">{{ $stats['pending'] }}</p>
                </div>
                <p class="text-gray-500 text-[10px] font-bold mt-1 uppercase tracking-wide">Menunggu Respon</p>
            </div>

            {{-- Proses Card --}}
            <div class="bg-white rounded-2xl p-4 shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-blue-100/80 flex flex-col gap-2 transition-transform active:scale-95">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center border border-blue-100/50">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </div>
                    <p class="text-3xl font-black text-blue-600 leading-none">{{ $stats['proses'] }}</p>
                </div>
                <p class="text-gray-500 text-[10px] font-bold mt-1 uppercase tracking-wide">Sedang Diproses</p>
            </div>

            {{-- Selesai Card --}}
            <div class="bg-white rounded-2xl p-4 shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-green-100/80 flex flex-col gap-2 transition-transform active:scale-95">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center border border-green-100/50">
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-3xl font-black text-green-600 leading-none">{{ $stats['selesai'] }}</p>
                </div>
                <p class="text-gray-500 text-[10px] font-bold mt-1 uppercase tracking-wide">Telah Selesai</p>
            </div>

            {{-- Total Card --}}
            <div class="bg-slate-800 rounded-2xl p-4 shadow-[0_8px_30px_rgb(0,0,0,0.1)] border border-slate-700 flex flex-col gap-2 transition-transform active:scale-95">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-xl bg-slate-700 flex items-center justify-center border border-slate-600">
                        <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <p class="text-3xl font-black text-white leading-none">{{ $stats['total'] }}</p>
                </div>
                <p class="text-slate-400 text-[10px] font-bold mt-1 uppercase tracking-wide">Total Masuk</p>
            </div>

        </div>
    </div>

    {{-- ═══════════════════════════════════════════════
         PENGADUAN TERBARU (Action Required List)
    ═══════════════════════════════════════════════ --}}
    <div class="px-5 mt-8">

        <div class="flex items-end justify-between mb-4">
            <div>
                <h3 class="font-black text-gray-900 text-base">Masuk Terbaru</h3>
                <p class="text-[11px] text-gray-500 mt-0.5 font-medium">Butuh penanganan segera</p>
            </div>
            <a href="{{ route('petugas.pengaduan.index') }}"
                class="text-blue-600 text-[11px] font-bold bg-blue-50 px-3 py-1.5 rounded-full hover:bg-blue-100 transition-colors tracking-wide uppercase">
                Lihat Semua
            </a>
        </div>

        <div class="space-y-3">
            @forelse($pengaduanTerbaru as $p)
                <a href="{{ route('petugas.pengaduan.show', $p->id_pengaduan) }}"
                    class="block bg-white rounded-2xl p-4 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.03)] border border-gray-100/80 active:scale-[0.98] transition-all duration-200 group">

                    <div class="flex items-start justify-between gap-3 mb-2.5">
                        <div class="flex items-center gap-2.5">
                            {{-- Avatar Initial --}}
                            <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center border border-gray-200 shrink-0">
                                <span class="text-xs font-black text-gray-600">{{ substr($p->masyarakat->nama, 0, 1) }}</span>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900 line-clamp-1">{{ $p->masyarakat->nama }}</p>
                                <div class="flex items-center gap-1 text-[10px] font-semibold text-gray-400">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $p->tgl_pengaduan->isoFormat('D MMM YYYY') }}
                                </div>
                            </div>
                        </div>
                        <span class="text-[10px] font-extrabold px-2.5 py-1 rounded-md uppercase tracking-wider shrink-0 {{ $p->status_color }}">
                            {{ $p->status_label }}
                        </span>
                    </div>

                    <div class="bg-gray-50/50 rounded-xl p-3 border border-gray-100 group-hover:bg-blue-50/30 transition-colors">
                        <p class="text-sm text-gray-700 font-medium leading-relaxed line-clamp-2">
                            {{ $p->isi_laporan }}
                        </p>
                    </div>
                </a>
            @empty
                {{-- Empty State --}}
                <div class="bg-white rounded-3xl p-8 text-center shadow-sm border border-gray-100/80">
                    <div class="w-16 h-16 bg-green-50 rounded-2xl mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h4 class="text-gray-900 font-extrabold mb-1">Semua Terkendali</h4>
                    <p class="text-gray-500 text-xs mb-5 font-medium">Belum ada laporan pengaduan baru yang masuk saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection