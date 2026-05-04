@extends('layouts.app')
@section('title', 'Edit Petugas')
@section('back_url', route('admin.petugas.index'))

@section('content')
<div class="pb-28 bg-gray-50/50 min-h-screen">

    {{-- ───────────────────────────────────────────────
         HEADER (Sticky Context)
    ─────────────────────────────────────────────── --}}
    <div class="bg-white px-5 pt-6 pb-6 shadow-[0_4px_20px_rgb(0,0,0,0.02)] rounded-b-3xl border-b border-gray-100 mb-6 sticky top-0 z-20">
        <h1 class="text-xl font-black text-gray-900 tracking-tight leading-tight">Edit Profil Pengguna</h1>
        <p class="text-xs text-gray-500 font-medium mt-1">Perbarui informasi data diri atau hak akses akun.</p>
    </div>

    <div class="px-5">
        
        {{-- ───────────────────────────────────────────────
             INFO BANNER (Password Opsional)
        ─────────────────────────────────────────────── --}}
        <div class="bg-blue-50/80 border border-blue-200/60 rounded-2xl p-4 mb-6 flex gap-3 shadow-sm">
            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center shrink-0">
                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h4 class="text-xs font-bold text-blue-800 mb-0.5">Informasi Keamanan</h4>
                <p class="text-[11px] font-medium text-blue-600/90 leading-relaxed">
                    Anda tidak perlu mengisi kolom password di bawah jika tidak ingin mengubah password saat ini. Biarkan saja kosong.
                </p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.petugas.update', $petugas->id_petugas) }}" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- ───────────────────────────────────────────────
                 PESAN ERROR GLOBAL
            ─────────────────────────────────────────────── --}}
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-2xl p-4 flex gap-3 shadow-sm mb-6">
                    <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <div>
                        <h4 class="text-xs font-bold text-red-800 mb-1">Terdapat kesalahan pengisian:</h4>
                        <ul class="text-xs text-red-600 font-medium space-y-1 list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- ───────────────────────────────────────────────
                 FORM CARD
            ─────────────────────────────────────────────── --}}
            <div class="bg-white rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 space-y-5 relative overflow-hidden">
                <div class="absolute right-0 top-0 w-32 h-32 bg-amber-50/50 rounded-bl-full -z-10"></div>
                
                <h3 class="text-[11px] font-black text-gray-400 uppercase tracking-widest mb-4 flex items-center gap-2 border-b border-gray-50 pb-3">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Data Personal
                </h3>

                {{-- Nama Lengkap --}}
                <div>
                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 {{ $errors->has('nama_petugas') ? 'text-red-400' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <input type="text" name="nama_petugas" value="{{ old('nama_petugas', $petugas->nama_petugas) }}" placeholder="Contoh: Budi Santoso"
                            class="w-full pl-11 pr-4 py-3.5 border rounded-2xl text-sm font-semibold text-gray-800 placeholder-gray-400 transition-all focus:outline-none focus:ring-2 focus:bg-white
                            {{ $errors->has('nama_petugas') ? 'border-red-300 bg-red-50/50 focus:ring-red-500/20 focus:border-red-500' : 'border-gray-200 bg-gray-50 focus:ring-blue-500/20 focus:border-blue-500' }}" />
                    </div>
                </div>

                {{-- Telepon & Username --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">
                            Username <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 {{ $errors->has('username') ? 'text-red-400' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"/></svg>
                            </div>
                            <input type="text" name="username" value="{{ old('username', $petugas->username) }}"
                                class="w-full pl-11 pr-4 py-3.5 border rounded-2xl text-sm font-semibold text-gray-800 placeholder-gray-400 transition-all focus:outline-none focus:ring-2 focus:bg-white
                                {{ $errors->has('username') ? 'border-red-300 bg-red-50/50 focus:ring-red-500/20 focus:border-red-500' : 'border-gray-200 bg-gray-50 focus:ring-blue-500/20 focus:border-blue-500' }}" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">
                            Nomor Telepon
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <input type="tel" name="telp" value="{{ old('telp', $petugas->telp) }}" placeholder="08xx..."
                                class="w-full pl-11 pr-4 py-3.5 border border-gray-200 bg-gray-50 rounded-2xl text-sm font-semibold text-gray-800 placeholder-gray-400 transition-all focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" />
                        </div>
                    </div>
                </div>

                {{-- Level / Role --}}
                <div class="pt-2">
                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-3">
                        Pilih Hak Akses (Level) <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="level" value="petugas" class="peer sr-only" {{ old('level', $petugas->level) === 'petugas' ? 'checked' : '' }} />
                            <div class="p-4 border-2 border-gray-100 rounded-2xl bg-gray-50 peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:bg-gray-100 transition-all">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-sm font-black text-gray-600 peer-checked:text-blue-700">Petugas</span>
                                    <svg class="w-5 h-5 text-gray-300 peer-checked:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                            </div>
                        </label>

                        <label class="relative cursor-pointer group">
                            <input type="radio" name="level" value="admin" class="peer sr-only" {{ old('level', $petugas->level) === 'admin' ? 'checked' : '' }} />
                            <div class="p-4 border-2 border-gray-100 rounded-2xl bg-gray-50 peer-checked:border-amber-500 peer-checked:bg-amber-50 hover:bg-gray-100 transition-all">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-sm font-black text-gray-600 peer-checked:text-amber-700">Admin</span>
                                    <svg class="w-5 h-5 text-gray-300 peer-checked:text-amber-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- Password Area (Opsional) --}}
                <div class="pt-6 mt-4 border-t border-gray-50 space-y-5">
                    <h3 class="text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                        Ubah Password (Opsional)
                    </h3>
                    
                    <div>
                        <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">
                            Password Baru
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 {{ $errors->has('password') ? 'text-red-400' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2-2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <input type="password" name="password" placeholder="Kosongkan jika tidak diubah"
                                class="w-full pl-11 pr-4 py-3.5 border rounded-2xl text-sm font-semibold text-gray-800 placeholder-gray-400 transition-all focus:outline-none focus:ring-2 focus:bg-white
                                {{ $errors->has('password') ? 'border-red-300 bg-red-50/50 focus:ring-red-500/20 focus:border-red-500' : 'border-gray-200 bg-gray-50 focus:ring-blue-500/20 focus:border-blue-500' }}" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">
                            Konfirmasi Password Baru
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            </div>
                            <input type="password" name="password_confirmation" placeholder="Ulangi password baru di atas"
                                class="w-full pl-11 pr-4 py-3.5 border border-gray-200 bg-gray-50 rounded-2xl text-sm font-semibold text-gray-800 placeholder-gray-400 transition-all focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" />
                        </div>
                    </div>
                </div>

            </div>

            {{-- ───────────────────────────────────────────────
                 ACTION BUTTONS
            ─────────────────────────────────────────────── --}}
            <div class="pt-4 pb-8 space-y-3">
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white font-black py-4 rounded-2xl shadow-lg shadow-blue-200 transition-transform active:scale-[0.98] text-sm uppercase tracking-wider">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    Simpan Perubahan Data
                </button>
                
                <a href="{{ route('admin.petugas.index') }}"
                    class="block w-full text-center bg-white border border-gray-200 hover:bg-gray-50 text-gray-600 font-bold py-3.5 rounded-2xl transition-colors text-sm shadow-sm">
                    Batalkan & Kembali
                </a>
            </div>

        </form>
    </div>
</div>
@endsection