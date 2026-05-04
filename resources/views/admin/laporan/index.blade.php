@extends('layouts.app')
@section('title', 'Rekapitulasi Laporan')

@section('content')
<div class="pb-28 bg-gray-50/50 min-h-screen">

    {{-- ───────────────────────────────────────────────
         HEADER (Sticky Context)
    ─────────────────────────────────────────────── --}}
    <div class="bg-white px-5 pt-6 pb-4 shadow-[0_4px_20px_rgb(0,0,0,0.02)] rounded-b-3xl border-b border-gray-100 mb-6 sticky top-0 z-20">
        <h1 class="text-xl font-black text-gray-900 tracking-tight">Rekapitulasi Laporan</h1>
        <p class="text-xs text-gray-500 font-medium mt-1">Pusat data, filter, dan cetak laporan pengaduan.</p>
    </div>

    <div class="px-5 space-y-6">

        {{-- ───────────────────────────────────────────────
             STATISTIK REKAP (Executive Summary)
        ─────────────────────────────────────────────── --}}
        <div>
            <h3 class="text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Ringkasan Data
            </h3>
            
            <div class="grid grid-cols-3 gap-3">
                {{-- Total Data (Full Width Header) --}}
                <div class="col-span-3 bg-white rounded-2xl p-4 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 flex items-center justify-between relative overflow-hidden">
                    <div class="absolute right-0 top-0 w-24 h-24 bg-gray-50 rounded-bl-full -z-10"></div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gray-900 rounded-xl flex items-center justify-center text-white shadow-md">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-0.5">Total Hasil Filter</p>
                            <p class="text-2xl font-black text-gray-900 leading-none">{{ $rekap['total'] }} <span class="text-sm font-semibold text-gray-400">Laporan</span></p>
                        </div>
                    </div>
                </div>

                {{-- Status Cards --}}
                <div class="bg-red-50 rounded-2xl p-3 shadow-sm border border-red-100 flex flex-col items-center justify-center text-center">
                    <p class="text-xl font-black text-red-600">{{ $rekap['pending'] }}</p>
                    <p class="text-[10px] font-bold text-red-500 uppercase tracking-wide mt-1">Menunggu</p>
                </div>
                <div class="bg-blue-50 rounded-2xl p-3 shadow-sm border border-blue-100 flex flex-col items-center justify-center text-center">
                    <p class="text-xl font-black text-blue-600">{{ $rekap['proses'] }}</p>
                    <p class="text-[10px] font-bold text-blue-500 uppercase tracking-wide mt-1">Diproses</p>
                </div>
                <div class="bg-green-50 rounded-2xl p-3 shadow-sm border border-green-100 flex flex-col items-center justify-center text-center">
                    <p class="text-xl font-black text-green-600">{{ $rekap['selesai'] }}</p>
                    <p class="text-[10px] font-bold text-green-500 uppercase tracking-wide mt-1">Selesai</p>
                </div>
            </div>
        </div>

        {{-- ───────────────────────────────────────────────
             FILTER PANEL (Control Center)
        ─────────────────────────────────────────────── --}}
        <div class="bg-white rounded-2xl p-5 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100">
            <h3 class="text-sm font-black text-gray-900 mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                Filter Spesifik
            </h3>
            
            <form method="GET" action="{{ route('admin.laporan.index') }}" class="space-y-4">
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1.5 block">Dari Tgl</label>
                        <input type="date" name="dari" value="{{ request('dari') }}"
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-xs font-semibold text-gray-700 bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all" />
                    </div>
                    <div>
                        <label class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1.5 block">Sampai Tgl</label>
                        <input type="date" name="sampai" value="{{ request('sampai') }}"
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-xs font-semibold text-gray-700 bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all" />
                    </div>
                </div>
                
                <div>
                    <label class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1.5 block">Status Laporan</label>
                    <div class="relative">
                        <select name="status"
                            class="w-full appearance-none pl-4 pr-10 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-semibold text-gray-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                            <option value="">Semua Status</option>
                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>🔴 Menunggu</option>
                            <option value="proses" {{ request('status') === 'proses' ? 'selected' : '' }}>🔵 Diproses</option>
                            <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>🟢 Selesai</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </div>
                    </div>
                </div>

                <div class="flex gap-2 pt-1">
                    <button type="submit"
                        class="flex-1 bg-gray-900 hover:bg-gray-800 text-white py-3 rounded-xl text-sm font-bold shadow-md shadow-gray-200 transition-all active:scale-[0.98]">
                        Terapkan Filter
                    </button>
                    @if(request('dari') || request('sampai') || request('status'))
                        <a href="{{ route('admin.laporan.index') }}"
                            class="px-5 py-3 bg-red-50 hover:bg-red-100 text-red-600 rounded-xl text-sm font-bold transition-all flex items-center justify-center">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- ───────────────────────────────────────────────
             ACTION BUTTON (Print)
        ─────────────────────────────────────────────── --}}
        @if($pengaduans->isNotEmpty())
            <a href="{{ route('admin.laporan.cetak', request()->query()) }}" target="_blank"
                class="flex items-center justify-center gap-3 w-full bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-black py-4 rounded-2xl shadow-lg shadow-orange-200 transition-transform active:scale-[0.98]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                CETAK DOKUMEN REKAPITULASI
            </a>
        @endif

        {{-- ───────────────────────────────────────────────
             DATA LIST (Tabel Daftar)
        ─────────────────────────────────────────────── --}}
        <div>
            <h3 class="text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                Rincian Laporan
            </h3>
            
            <div class="space-y-3">
                @forelse($pengaduans as $p)
                    <div class="bg-white rounded-2xl p-4 shadow-[0_4px_15px_rgb(0,0,0,0.02)] border border-gray-100 relative overflow-hidden group">
                        
                        {{-- Left Color Indicator --}}
                        <div class="absolute left-0 top-0 bottom-0 w-1.5 
                            @if($p->status === '0') bg-red-500 
                            @elseif($p->status === 'proses') bg-blue-500 
                            @elseif($p->status === 'selesai') bg-green-500 
                            @else bg-gray-300 @endif">
                        </div>

                        <div class="pl-2">
                            <div class="flex items-start justify-between gap-2 mb-2">
                                <div>
                                    <p class="text-sm font-black text-gray-900 leading-tight">{{ $p->masyarakat->nama }}</p>
                                    <p class="text-[10px] font-mono font-bold text-gray-400 mt-0.5 tracking-wider">{{ $p->masyarakat->nik }}</p>
                                </div>
                                <span class="shrink-0 text-[10px] px-2.5 py-1 rounded-lg font-black uppercase tracking-wider {{ $p->status_color }}">
                                    {{ $p->status_label }}
                                </span>
                            </div>
                            
                            <p class="text-xs text-gray-600 font-medium line-clamp-2 mb-3 leading-relaxed">{{ $p->isi_laporan }}</p>
                            
                            <div class="flex flex-col gap-2 pt-3 border-t border-gray-50">
                                <p class="text-[11px] font-semibold text-gray-400 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    {{ $p->tgl_pengaduan->isoFormat('D MMM YYYY') }}
                                </p>
                                
                                @if($p->tanggapans->isNotEmpty())
                                    <div class="bg-gray-50 rounded-lg p-2 border border-gray-100">
                                        <p class="text-[10px] font-bold text-gray-500 flex items-center gap-1.5">
                                            <span class="bg-blue-100 text-blue-600 px-1.5 py-0.5 rounded text-[9px] uppercase tracking-wider">
                                                {{ $p->tanggapans->count() }} Respon
                                            </span>
                                            Terakhir oleh: <span class="text-gray-800">{{ $p->tanggapans->last()->petugas->nama_petugas }}</span>
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-3xl p-10 text-center shadow-sm border border-dashed border-gray-200">
                        <div class="w-16 h-16 bg-gray-50 rounded-2xl mx-auto mb-4 flex items-center justify-center border border-gray-100">
                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2" />
                            </svg>
                        </div>
                        <p class="text-gray-900 font-bold text-sm mb-1">Data Kosong</p>
                        <p class="text-gray-500 text-xs font-medium">Tidak ada data untuk kombinasi filter yang dipilih.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection