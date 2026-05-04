@extends('layouts.app')
@section('title', 'Manajemen Petugas')

@section('content')
<div class="pb-28 bg-gray-50/50 min-h-screen">

    {{-- ───────────────────────────────────────────────
         HEADER & TOP ACTIONS (Sticky)
    ─────────────────────────────────────────────── --}}
    <div class="bg-white px-5 pt-6 pb-6 shadow-[0_4px_20px_rgb(0,0,0,0.02)] rounded-b-3xl border-b border-gray-100 mb-6 sticky top-0 z-20">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h1 class="text-xl font-black text-gray-900 tracking-tight leading-tight">Manajemen Tim</h1>
                <p class="text-xs text-gray-500 font-medium mt-1">Kelola akses admin & petugas lapangan.</p>
            </div>
            <div class="w-10 h-10 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-full flex items-center justify-center border border-blue-100/50 shadow-sm">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
        </div>

        <a href="{{ route('admin.petugas.create') }}"
            class="group w-full flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white font-black py-4 rounded-2xl shadow-lg shadow-blue-200 transition-transform active:scale-[0.98] text-sm uppercase tracking-wider">
            <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Pengguna Baru
        </a>
    </div>

    {{-- ───────────────────────────────────────────────
         DAFTAR PENGGUNA (Cards)
    ─────────────────────────────────────────────── --}}
    <div class="px-5 space-y-4">
        @forelse($petugasList as $p)
            @php
                $isSelf = auth('petugas')->id() === $p->id_petugas;
            @endphp

            <div class="relative bg-white rounded-3xl p-5 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border {{ $isSelf ? 'border-blue-300' : 'border-gray-100' }} overflow-hidden transition-all hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)]">
                
                {{-- Decorative Background Setup for Self Account --}}
                @if($isSelf)
                    <div class="absolute right-0 top-0 w-24 h-24 bg-blue-50/50 rounded-bl-full -z-10"></div>
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-gradient-to-b from-blue-500 to-indigo-600 rounded-l-3xl"></div>
                @endif

                <div class="flex items-start justify-between">
                    <div class="flex items-center gap-3.5">
                        {{-- Avatar --}}
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center border-2 border-white shadow-sm shrink-0
                            {{ $p->level === 'admin' ? 'bg-gradient-to-br from-amber-100 to-amber-200' : 'bg-gradient-to-br from-blue-100 to-indigo-200' }}">
                            <span class="text-lg font-black {{ $p->level === 'admin' ? 'text-amber-700' : 'text-blue-700' }}">
                                {{ strtoupper(substr($p->nama_petugas, 0, 1)) }}
                            </span>
                        </div>
                        
                        {{-- Info --}}
                        <div>
                            <div class="flex items-center gap-2 mb-0.5">
                                <h3 class="text-sm font-black text-gray-900 leading-none">{{ $p->nama_petugas }}</h3>
                            </div>
                            <div class="flex items-center gap-2 mt-1.5">
                                <p class="text-[11px] text-gray-500 font-semibold bg-gray-50 px-2 py-0.5 rounded-md border border-gray-100">
                                    {{ '@' . $p->username }}
                                </p>
                                @if($isSelf)
                                    <span class="text-[9px] font-black bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-2 py-0.5 rounded-md uppercase tracking-wider shadow-sm">
                                        Anda
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Role Badge --}}
                    <span class="text-[9px] px-2.5 py-1 rounded-lg font-black uppercase tracking-widest shrink-0
                        {{ $p->level === 'admin' ? 'bg-amber-50 text-amber-600 border border-amber-100/50' : 'bg-blue-50 text-blue-600 border border-blue-100/50' }}">
                        {{ $p->level }}
                    </span>
                </div>

                {{-- Kontak --}}
                @if($p->telp)
                    <div class="mt-4 flex items-center gap-2 text-xs font-semibold text-gray-600 bg-gray-50/80 p-3 rounded-2xl border border-gray-100/80">
                        <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        {{ $p->telp }}
                    </div>
                @endif

                {{-- Action Buttons --}}
                <div class="flex gap-3 mt-4 pt-4 border-t border-gray-50">
                    <a href="{{ route('admin.petugas.edit', $p->id_petugas) }}"
                        class="flex-1 flex items-center justify-center gap-1.5 py-3 bg-blue-50/50 hover:bg-blue-100/80 text-blue-700 rounded-2xl text-[11px] font-black uppercase tracking-wider transition-colors active:scale-95 border border-blue-100/50">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                    </a>
                    
                    @if(!$isSelf)
                        <form method="POST"
                            action="{{ route('admin.petugas.destroy', $p->id_petugas) }}"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus akses untuk {{ $p->nama_petugas }}? Tindakan ini tidak dapat dibatalkan.')"
                            class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full flex items-center justify-center gap-1.5 py-3 bg-red-50/50 hover:bg-red-100/80 text-red-600 rounded-2xl text-[11px] font-black uppercase tracking-wider transition-colors active:scale-95 border border-red-100/50">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Hapus
                            </button>
                        </form>
                    @else
                        <div class="flex-1 flex items-center justify-center gap-1.5 py-3 bg-gray-50 border border-gray-100 text-gray-400 rounded-2xl text-[11px] font-black uppercase tracking-wider cursor-not-allowed">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Sedang Digunakan
                        </div>
                    @endif
                </div>
            </div>
        @empty
            {{-- Empty State --}}
            <div class="bg-white rounded-3xl p-8 text-center shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100">
                <div class="w-16 h-16 bg-blue-50 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h4 class="text-gray-900 font-extrabold text-sm mb-1">Tim Masih Kosong</h4>
                <p class="text-gray-500 text-xs font-medium leading-relaxed">Belum ada akun admin atau petugas yang terdaftar di dalam sistem selain Anda.</p>
            </div>
        @endforelse

        {{-- Pagination --}}
        @if($petugasList->hasPages())
            <div class="pt-6 pb-2">
                {{ $petugasList->links('vendor.pagination.simple-tailwind') }}
            </div>
        @endif
    </div>
</div>
@endsection