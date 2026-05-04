@extends('layouts.app')
@section('title', 'Beranda')

@section('content')
<div class="pb-28 bg-gray-50/50 min-h-screen">
    

    {{-- ═══════════════════════════════════════════════
         HERO SECTION (Modern Gradient + BATIK MEGAMENDUNG)
    ═══════════════════════════════════════════════ --}}
    <div class="relative bg-gradient-to-br from-blue-700 via-blue-800 to-indigo-900 px-5 pt-8 pb-16 overflow-hidden rounded-b-[2rem] shadow-sm">

        {{-- Motif Batik Megamendung (SVG Pattern Background) --}}
        <div class="absolute inset-0 z-0 opacity-[0.08] mix-blend-overlay pointer-events-none">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="megamendung" x="0" y="0" width="100" height="60" patternUnits="userSpaceOnUse">
                        {{-- Lapisan Awan Megamendung --}}
                        <path d="M0 60 Q 25 20 50 60 T 100 60" fill="none" stroke="#ffffff" stroke-width="6" stroke-linecap="round"/>
                        <path d="M0 50 Q 25 10 50 50 T 100 50" fill="none" stroke="#ffffff" stroke-width="4" stroke-linecap="round"/>
                        <path d="M0 40 Q 25 0 50 40 T 100 40" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round"/>
                        <path d="M0 30 Q 25 -10 50 30 T 100 30" fill="none" stroke="#ffffff" stroke-width="1" stroke-linecap="round"/>
                    </pattern>
                </defs>
                <rect x="0" y="0" width="100%" height="100%" fill="url(#megamendung)"></rect>
            </svg>
        </div>

        {{-- Dekorasi Cahaya Organik (Memperkuat kesan kedalaman) --}}
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-gradient-to-br from-blue-300/30 to-transparent rounded-full blur-2xl pointer-events-none z-0"></div>
        <div class="absolute bottom-0 right-10 w-24 h-24 bg-white/10 rounded-full blur-xl pointer-events-none z-0"></div>
        <div class="absolute -bottom-5 -left-5 w-32 h-32 bg-indigo-500/30 rounded-full blur-2xl pointer-events-none z-0"></div>

        {{-- Profil & Greeting --}}
        <div class="relative z-10 flex items-center justify-between mt-2">
            <div>
                <p class="text-blue-200/90 text-[11px] font-bold tracking-widest uppercase mb-1 drop-shadow-md">
                    Selamat datang,
                </p>
                <h2 class="text-white text-2xl font-extrabold tracking-tight drop-shadow-md">
                    {{ $masyarakat->nama }}
                </h2>
                
                {{-- NIK Pill --}}
                <div class="inline-flex items-center gap-2 mt-3 bg-white/10 backdrop-blur-md border border-white/20 rounded-full px-3.5 py-1.5 shadow-inner">
                    <svg class="w-3.5 h-3.5 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                    </svg>
                    <span class="text-white text-[11px] font-mono font-bold tracking-[0.15em] opacity-95">
                        {{ implode(' ', str_split($masyarakat->nik, 4)) }}
                    </span>
                </div>
            </div>
            
            {{-- Avatar --}}
            <div class="w-14 h-14 rounded-full bg-white/10 backdrop-blur-md border-2 border-white/30 flex items-center justify-center shadow-lg transform transition active:scale-95">
                <span class="text-white font-black text-xl drop-shadow-sm">{{ substr($masyarakat->nama, 0, 1) }}</span>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════
         STAT CARDS (Floating, 2x2 Grid)
    ═══════════════════════════════════════════════ --}}
    <div class="px-5 -mt-8 relative z-20">
        <div class="grid grid-cols-2 gap-3">
            
            {{-- Total Card --}}
            <div class="bg-white rounded-2xl p-4 shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-gray-100/80 flex items-center gap-4 transition-transform active:scale-95">
                <div class="w-11 h-11 rounded-xl bg-gray-50 flex items-center justify-center border border-gray-100">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-black text-gray-800 leading-none">{{ $stats['total'] }}</p>
                    <p class="text-gray-400 text-[10px] font-bold mt-1 uppercase tracking-wide">Total Laporan</p>
                </div>
            </div>

            {{-- Menunggu Card --}}
            <div class="bg-white rounded-2xl p-4 shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-amber-100/80 flex items-center gap-4 transition-transform active:scale-95">
                <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center border border-amber-100/50">
                    <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-black text-amber-600 leading-none">{{ $stats['pending'] }}</p>
                    <p class="text-gray-400 text-[10px] font-bold mt-1 uppercase tracking-wide">Menunggu</p>
                </div>
            </div>

            {{-- Proses Card --}}
            <div class="bg-white rounded-2xl p-4 shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-blue-100/80 flex items-center gap-4 transition-transform active:scale-95">
                <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center border border-blue-100/50">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-black text-blue-600 leading-none">{{ $stats['proses'] }}</p>
                    <p class="text-gray-400 text-[10px] font-bold mt-1 uppercase tracking-wide">Diproses</p>
                </div>
            </div>

            {{-- Selesai Card --}}
            <div class="bg-white rounded-2xl p-4 shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-green-100/80 flex items-center gap-4 transition-transform active:scale-95">
                <div class="w-11 h-11 rounded-xl bg-green-50 flex items-center justify-center border border-green-100/50">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-black text-green-600 leading-none">{{ $stats['selesai'] }}</p>
                    <p class="text-gray-400 text-[10px] font-bold mt-1 uppercase tracking-wide">Selesai</p>
                </div>
            </div>

        </div>
    </div>

    {{-- ═══════════════════════════════════════════════
         CTA BANNER — Action Oriented
    ═══════════════════════════════════════════════ --}}
    <div class="px-5 mt-7">
        <a href="{{ route('masyarakat.pengaduan.create') }}"
            class="group relative flex items-center justify-between p-4 bg-white rounded-2xl border-2 border-blue-600 border-dashed hover:border-solid hover:bg-blue-50/50 transition-all duration-300 active:scale-[0.98] overflow-hidden shadow-sm">
            
            <div class="absolute inset-0 bg-blue-50/50 transform -skew-x-12 -translate-x-full group-hover:translate-x-0 transition-transform duration-500"></div>

            <div class="relative z-10 flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center shadow-lg shadow-blue-200">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-gray-900 font-extrabold text-sm">Buat Laporan Baru</h3>
                    <p class="text-gray-500 text-xs mt-0.5 font-medium">Sampaikan keluhan Anda di sini</p>
                </div>
            </div>
            
            <div class="relative z-10">
                <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center group-hover:bg-blue-100 transition-colors">
                    <svg class="w-4 h-4 text-blue-600 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </div>
        </a>
    </div>

    {{-- ═══════════════════════════════════════════════
         LAPORAN TERBARU (Timeline Style)
    ═══════════════════════════════════════════════ --}}
    <div class="px-5 mt-8">

        <div class="flex items-end justify-between mb-4">
            <div>
                <h3 class="font-black text-gray-900 text-base">Aktivitas Terkini</h3>
                <p class="text-[11px] text-gray-500 mt-0.5 font-medium">Laporan terakhir yang Anda buat</p>
            </div>
            <a href="{{ route('masyarakat.pengaduan.index') }}"
                class="text-blue-600 text-[11px] font-bold bg-blue-50 px-3 py-1.5 rounded-full hover:bg-blue-100 transition-colors tracking-wide uppercase">
                Lihat Semua
            </a>
        </div>

        <div class="space-y-3">
            @forelse($laporanTerbaru as $laporan)
                <a href="{{ route('masyarakat.pengaduan.show', $laporan->id_pengaduan) }}"
                    class="block bg-white rounded-2xl p-4 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.03)] border border-gray-100/80 active:scale-[0.98] transition-all duration-200">

                    <div class="flex items-start justify-between gap-3 mb-3">
                        <div class="flex flex-col">
                            <span class="text-[10px] font-mono font-bold text-gray-400 uppercase tracking-widest mb-1">
                                TIKET #{{ str_pad($laporan->id_pengaduan, 4, '0', STR_PAD_LEFT) }}
                            </span>
                            <div class="flex items-center gap-1.5 text-xs font-semibold text-gray-500">
                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $laporan->tgl_pengaduan->isoFormat('D MMM YYYY') }}
                            </div>
                        </div>
                        <span class="text-[10px] font-extrabold px-2.5 py-1 rounded-md uppercase tracking-wider {{ $laporan->status_color }}">
                            {{ $laporan->status_label }}
                        </span>
                    </div>

                    <p class="text-sm text-gray-800 font-medium leading-relaxed line-clamp-2">
                        {{ $laporan->isi_laporan }}
                    </p>

                    @if($laporan->foto || $laporan->tanggapans->isNotEmpty())
                        <div class="flex items-center gap-2.5 mt-3.5 pt-3.5 border-t border-gray-50">
                            @if($laporan->foto)
                                <span class="flex items-center gap-1.5 text-[10px] font-bold text-gray-500 bg-gray-50 border border-gray-100 px-2 py-1 rounded-md uppercase tracking-wide">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Lampiran
                                </span>
                            @endif

                            @if($laporan->tanggapans->isNotEmpty())
                                <span class="flex items-center gap-1.5 text-[10px] font-bold text-blue-600 bg-blue-50 border border-blue-100 px-2 py-1 rounded-md uppercase tracking-wide">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    {{ $laporan->tanggapans->count() }} Balasan
                                </span>
                            @endif
                        </div>
                    @endif
                </a>
            @empty
                {{-- Empty State --}}
                <div class="bg-white rounded-3xl p-8 text-center shadow-sm border border-gray-100/80">
                    <div class="w-16 h-16 bg-blue-50 rounded-2xl mx-auto mb-4 flex items-center justify-center transform rotate-3">
                        <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </div>
                    <h4 class="text-gray-900 font-extrabold mb-1">Kotak Laporan Kosong</h4>
                    <p class="text-gray-500 text-xs mb-5 font-medium">Belum ada riwayat aktivitas. Yuk, mulai buat laporan pertama Anda.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection