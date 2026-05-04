@extends('layouts.app')
@section('title', 'Edit Profil')
@section('back_url', route('masyarakat.profile.index'))

@section('content')
<div class="px-4 pt-5 pb-10">

    {{-- Avatar mini header --}}
    <div class="flex items-center gap-3 mb-6">
        <div class="w-12 h-12 rounded-full bg-blue-700 flex items-center
                    justify-center flex-shrink-0">
            <span class="text-white text-lg font-bold">
                {{ strtoupper(substr($masyarakat->nama, 0, 1)) }}{{ strtoupper(substr(explode(' ', $masyarakat->nama)[1] ?? 'X', 0, 1)) }}
            </span>
        </div>
        <div>
            <p class="text-sm font-bold text-gray-800">{{ $masyarakat->nama }}</p>
            <p class="text-xs text-gray-400">@{{ $masyarakat->username }}</p>
        </div>
    </div>

    <form method="POST" action="{{ route('masyarakat.profile.update') }}"
          class="space-y-4">
        @csrf
        @method('PUT')

        {{-- Nama --}}
        <div class="space-y-1.5">
            <label class="block text-sm font-semibold text-gray-700">
                Nama Lengkap <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center
                             pl-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12
                               14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </span>
                <input type="text" name="nama"
                    value="{{ old('nama', $masyarakat->nama) }}"
                    placeholder="Nama lengkap Anda"
                    class="w-full pl-10 pr-4 py-3 text-sm border rounded-xl
                           bg-gray-50 focus:outline-none focus:ring-2
                           focus:ring-blue-500 focus:bg-white transition
                           {{ $errors->has('nama')
                               ? 'border-red-400 bg-red-50'
                               : 'border-gray-200' }}" />
            </div>
            @error('nama')
                <p class="text-red-500 text-xs flex items-center gap-1">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1
                               0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1
                               1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- NIK (readonly) --}}
        <div class="space-y-1.5">
            <label class="block text-sm font-semibold text-gray-700">NIK</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center
                             pl-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-amber-400" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0
                               00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4
                               4 0 00-8 0v4h8z"/>
                    </svg>
                </span>
                <input type="text" readonly
                    value="{{ implode(' ', str_split($masyarakat->nik, 4)) }}"
                    class="w-full pl-10 pr-4 py-3 text-sm border border-amber-200
                           rounded-xl bg-amber-50 text-amber-700 font-mono
                           tracking-wider cursor-not-allowed" />
            </div>
            <p class="text-[11px] text-amber-600 flex items-center gap-1">
                <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58
                           9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53
                           0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0
                           11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0
                           002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                NIK tidak dapat diubah.
            </p>
        </div>

        {{-- Username (readonly) --}}
        <div class="space-y-1.5">
            <label class="block text-sm font-semibold text-gray-700">Username</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center
                             pl-3.5 pointer-events-none text-gray-400 text-sm">@</span>
                <input type="text" readonly
                    value="{{ $masyarakat->username }}"
                    class="w-full pl-8 pr-4 py-3 text-sm border border-gray-200
                           rounded-xl bg-gray-100 text-gray-500 cursor-not-allowed" />
            </div>
            <p class="text-[11px] text-gray-400">Username tidak dapat diubah.</p>
        </div>

        {{-- Telepon --}}
        <div class="space-y-1.5">
            <label class="block text-sm font-semibold text-gray-700">
                No. Telepon
                <span class="font-normal text-gray-400">(opsional)</span>
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center
                             pl-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498
                               4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042
                               11.042 0 005.516 5.516l1.13-2.257a1 1 0
                               011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2
                               2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </span>
                <input type="tel" name="telp" inputmode="numeric"
                    value="{{ old('telp', $masyarakat->telp) }}"
                    placeholder="Contoh: 081234567890"
                    class="w-full pl-10 pr-4 py-3 text-sm border rounded-xl
                           bg-gray-50 focus:outline-none focus:ring-2
                           focus:ring-blue-500 focus:bg-white transition
                           {{ $errors->has('telp')
                               ? 'border-red-400 bg-red-50'
                               : 'border-gray-200' }}" />
            </div>
            @error('telp')
                <p class="text-red-500 text-xs flex items-center gap-1">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1
                               0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1
                               1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Tombol --}}
        <div class="pt-2 space-y-2">
            <button type="submit"
                class="w-full bg-blue-700 hover:bg-blue-800 active:scale-95
                       text-white font-semibold py-3.5 rounded-2xl transition
                       shadow-md text-sm">
                Simpan Perubahan
            </button>
            <a href="{{ route('masyarakat.profile.index') }}"
                class="block text-center text-sm text-gray-500 py-2.5
                       rounded-xl hover:bg-gray-100 transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection