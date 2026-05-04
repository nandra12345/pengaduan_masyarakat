@extends('layouts.app')
@section('title', 'Detail Laporan')
@section('back_url', route('masyarakat.pengaduan.index'))

@section('content')
    <div class="px-4 pt-4 space-y-4">

        {{-- Status Badge Besar --}}
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-mono text-gray-400">
                    #{{ str_pad($pengaduan->id_pengaduan, 4, '0', STR_PAD_LEFT) }}
                </span>
                <span class="text-sm px-3 py-1.5 rounded-full font-semibold {{ $pengaduan->status_color }}">
                    {{ $pengaduan->status_label }}
                </span>
            </div>
            <p class="text-xs text-gray-400 mb-3">
                📅 Dilaporkan: {{ $pengaduan->tgl_pengaduan->isoFormat('dddd, D MMMM YYYY') }}
            </p>
            <div class="border-t border-gray-100 pt-3">
                <p class="text-sm font-medium text-gray-600 mb-1">Isi Laporan:</p>
                <p class="text-sm text-gray-800 leading-relaxed">{{ $pengaduan->isi_laporan }}</p>
            </div>
        </div>

        {{-- Foto Bukti --}}
        @if($pengaduan->foto)
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100">
                <p class="text-sm font-semibold text-gray-700 mb-3">📷 Foto Pendukung</p>
                <img src="{{ asset('storage/' . $pengaduan->foto) }}"
                    alt="Foto laporan"
                    class="w-full rounded-xl object-cover max-h-64"
                    onclick="this.classList.toggle('max-h-64')" />
                <p class="text-xs text-gray-400 mt-2 text-center">Tap foto untuk memperbesar</p>
            </div>
        @endif

        {{-- Riwayat Tanggapan --}}
        <div>
            <h3 class="font-semibold text-gray-800 mb-3">
                💬 Tanggapan Petugas
                @if($pengaduan->tanggapans->isNotEmpty())
                    <span class="text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full ml-1">
                        {{ $pengaduan->tanggapans->count() }}
                    </span>
                @endif
            </h3>

            @forelse($pengaduan->tanggapans as $tanggapan)
                <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 mb-3">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-700">
                                    {{ $tanggapan->petugas->nama_petugas }}
                                </p>
                                <p class="text-xs text-gray-400">
                                    {{ ucfirst($tanggapan->petugas->level) }}
                                </p>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400">
                            {{ $tanggapan->tgl_tanggapan->isoFormat('D MMM YYYY') }}
                        </p>
                    </div>
                    <p class="text-sm text-gray-700 leading-relaxed">{{ $tanggapan->tanggapan }}</p>
                </div>
            @empty
                <div class="bg-gray-50 rounded-2xl p-6 text-center border border-dashed border-gray-300">
                    <p class="text-gray-400 text-sm">Belum ada tanggapan dari petugas.</p>
                    <p class="text-gray-400 text-xs mt-1">Harap bersabar, laporan Anda sedang diproses.</p>
                </div>
            @endforelse
        </div>

    </div>
@endsection