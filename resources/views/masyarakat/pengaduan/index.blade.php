@extends('layouts.app')
@section('title', 'Laporan Saya')

@section('content')
    <div class="px-4 pt-4 pb-8 space-y-4">

        {{-- Header Info --}}
        <div class="flex items-center justify-between pb-1">
            <h2 class="text-lg font-bold text-gray-800 tracking-tight">Riwayat Pengaduan</h2>
            <div class="bg-blue-50/80 border border-blue-100 px-3 py-1 rounded-full flex items-center gap-1.5">
                <span class="relative flex h-2 w-2">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                </span>
                <span class="text-xs font-semibold text-blue-700">{{ $pengaduans->total() }} Laporan</span>
            </div>
        </div>

        {{-- List Laporan --}}
        <div class="space-y-3">
            @forelse($pengaduans as $laporan)
                <a href="{{ route('masyarakat.pengaduan.show', $laporan->id_pengaduan) }}"
                    class="group relative block bg-white rounded-2xl p-4 border border-gray-100 shadow-sm hover:shadow-md hover:border-blue-200 transition-all duration-200 active:scale-[0.98] active:bg-gray-50 overflow-hidden">
                    
                    {{-- Aksen Garis Kiri (Opsional, memberi kesan kartu dinamis) --}}
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-gray-100 to-gray-50 group-hover:from-blue-400 group-hover:to-blue-500 transition-colors"></div>

                    <div class="flex items-start justify-between gap-3 mb-2.5 pl-2">
                        <div class="flex flex-col">
                            <span class="text-[11px] font-mono font-medium text-gray-400 tracking-wider">
                                TIKET #{{ str_pad($laporan->id_pengaduan, 4, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>
                        {{-- Status Pill --}}
                        <span class="text-[11px] px-2.5 py-1 rounded-full font-bold uppercase tracking-wide {{ $laporan->status_color }}">
                            {{ $laporan->status_label }}
                        </span>
                    </div>

                    <p class="text-sm text-gray-700 leading-relaxed line-clamp-2 mb-3 pl-2 group-hover:text-gray-900">
                        {{ $laporan->isi_laporan }}
                    </p>

                    <div class="flex items-center justify-between border-t border-gray-50 pt-3 pl-2 mt-2">
                        {{-- Tanggal dengan Icon SVG --}}
                        <div class="flex items-center gap-1.5 text-gray-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-xs font-medium">{{ $laporan->tgl_pengaduan->isoFormat('D MMM YYYY') }}</span>
                        </div>

                        {{-- Indikator Foto & Tanggapan --}}
                        <div class="flex items-center gap-3">
                            @if($laporan->foto)
                                <div class="flex items-center gap-1 text-gray-400">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif

                            @if($laporan->tanggapans->isNotEmpty())
                                <div class="flex items-center gap-1 text-blue-500 bg-blue-50 px-2 py-0.5 rounded-md">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    <span class="text-xs font-bold">{{ $laporan->tanggapans->count() }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </a>
            @empty
                {{-- Empty State Modern --}}
                <div class="bg-gray-50/50 rounded-3xl p-10 text-center border-2 border-dashed border-gray-200 flex flex-col items-center justify-center">
                    <div class="bg-white p-4 rounded-full shadow-sm mb-4">
                        <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-gray-800 text-sm font-bold mb-1">Belum Ada Laporan</h3>
                    <p class="text-gray-500 text-xs">Tap tombol + di bawah untuk mulai menyuarakan laporan Anda.</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($pengaduans->hasPages())
            <div class="pt-4 pb-6">
                {{ $pengaduans->links('vendor.pagination.simple-tailwind') }}
            </div>
        @endif
    </div>
@endsection