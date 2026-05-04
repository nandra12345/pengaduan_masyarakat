@extends('layouts.app')
@section('title', 'Daftar Pengaduan')

@section('content')
<div class="pb-24 bg-gray-50/50 min-h-screen">

    {{-- ───────────────────────────────────────────────
         HEADER & FILTER SECTION (Sticky)
    ─────────────────────────────────────────────── --}}
    <div class="bg-white px-5 pt-6 pb-5 shadow-[0_4px_20px_rgb(0,0,0,0.02)] rounded-b-3xl border-b border-gray-100 sticky top-0 z-20">
        <div class="mb-4">
            <h1 class="text-xl font-black text-gray-900 tracking-tight">Daftar Pengaduan</h1>
            <p class="text-xs text-gray-500 mt-1 font-medium">
                Menampilkan <span class="font-bold text-blue-600">{{ $pengaduans->total() }}</span> laporan masuk
            </p>
        </div>

        <form method="GET" action="{{ route('petugas.pengaduan.index') }}" class="space-y-3">
            {{-- Search Input --}}
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama pelapor atau isi laporan..."
                    class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-medium text-gray-900 placeholder-gray-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all shadow-sm" />
            </div>

            {{-- Filter Dropdown & Buttons --}}
            <div class="flex gap-2.5">
                <div class="relative flex-1">
                    <select name="status"
                        class="w-full appearance-none pl-4 pr-10 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-semibold text-gray-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all shadow-sm">
                        <option value="">Semua Status</option>
                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>🔴 Menunggu</option>
                        <option value="proses" {{ request('status') === 'proses' ? 'selected' : '' }}>🔵 Diproses</option>
                        <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>🟢 Selesai</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
                
                <button type="submit"
                    class="px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl text-sm font-bold shadow-md shadow-blue-200 active:scale-95 transition-all">
                    Filter
                </button>

                @if(request('search') || request('status'))
                    <a href="{{ route('petugas.pengaduan.index') }}"
                        class="px-4 py-3 bg-red-50 hover:bg-red-100 text-red-600 rounded-2xl text-sm font-bold active:scale-95 transition-all flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- ───────────────────────────────────────────────
         DAFTAR PENGADUAN (Ticket Style)
    ─────────────────────────────────────────────── --}}
    <div class="px-5 pt-6 space-y-4">
        @forelse($pengaduans as $p)
            <a href="{{ route('petugas.pengaduan.show', $p->id_pengaduan) }}"
                class="block relative bg-white rounded-2xl p-5 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 overflow-hidden transition-transform hover:-translate-y-0.5 active:scale-[0.98] group">
                
                {{-- Left Accent Border based on status logic (fallback to gray if status_color logic doesn't use bg-xxx directly here) --}}
                <div class="absolute left-0 top-0 bottom-0 w-1.5 rounded-l-2xl 
                    @if($p->status === '0') bg-red-500 
                    @elseif($p->status === 'proses') bg-blue-500 
                    @elseif($p->status === 'selesai') bg-green-500 
                    @else bg-gray-300 @endif">
                </div>

                {{-- Card Header --}}
                <div class="flex items-start justify-between gap-3 mb-3 pl-2">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center border border-gray-100 shrink-0">
                            <span class="text-sm font-black text-gray-500">{{ substr($p->masyarakat->nama, 0, 1) }}</span>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-900 leading-tight">{{ $p->masyarakat->nama }}</p>
                            <div class="flex items-center gap-1.5 mt-0.5">
                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                </svg>
                                <p class="text-[11px] text-gray-500 font-mono font-semibold tracking-widest">{{ $p->masyarakat->nik }}</p>
                            </div>
                        </div>
                    </div>
                    <span class="shrink-0 text-[10px] px-2.5 py-1.5 rounded-lg font-black uppercase tracking-wider {{ $p->status_color }}">
                        {{ $p->status_label }}
                    </span>
                </div>

                {{-- Card Body --}}
                <div class="bg-gray-50/50 rounded-xl p-3.5 border border-gray-50 ml-2 group-hover:bg-blue-50/30 transition-colors">
                    <p class="text-sm text-gray-700 font-medium leading-relaxed line-clamp-2">
                        {{ $p->isi_laporan }}
                    </p>
                </div>

                {{-- Card Footer --}}
                <div class="flex items-center justify-between mt-4 pt-3 border-t border-gray-100 ml-2">
                    <div class="flex items-center gap-1.5 text-[11px] font-semibold text-gray-500">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ $p->tgl_pengaduan->isoFormat('D MMM YYYY') }}
                    </div>
                    
                    <div class="flex items-center gap-2">
                        @if($p->foto)
                            <span class="flex items-center gap-1 bg-gray-100 text-gray-600 px-2 py-1 rounded-md text-[10px] font-bold uppercase tracking-wide">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Foto
                            </span>
                        @endif

                        @if($p->tanggapans_count ?? $p->tanggapans->count())
                            <span class="flex items-center gap-1 bg-blue-50 text-blue-600 border border-blue-100 px-2 py-1 rounded-md text-[10px] font-bold uppercase tracking-wide">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                {{ $p->tanggapans->count() }} Balasan
                            </span>
                        @endif
                    </div>
                </div>
            </a>
        @empty
            {{-- Empty State --}}
            <div class="bg-white rounded-3xl p-8 text-center shadow-sm border border-gray-100 mt-4">
                <div class="w-16 h-16 bg-gray-50 rounded-2xl mx-auto mb-4 flex items-center justify-center border border-gray-100">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h4 class="text-gray-900 font-extrabold mb-1">Data Tidak Ditemukan</h4>
                <p class="text-gray-500 text-xs mb-2 font-medium">Coba gunakan kata kunci pencarian atau filter status yang lain.</p>
            </div>
        @endforelse

        {{-- Pagination --}}
        @if($pengaduans->hasPages())
            <div class="pt-4 pb-6">
                {{ $pengaduans->links('vendor.pagination.simple-tailwind') }}
            </div>
        @endif
    </div>
</div>
@endsection