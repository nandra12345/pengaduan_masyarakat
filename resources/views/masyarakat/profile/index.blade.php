@extends('layouts.app')
@section('title', 'Profil Saya')

@section('content')
<div class="pb-24 bg-gray-50/50 min-h-screen">

    {{-- ── HERO AVATAR ─────────────────────────────────────────────── --}}
    <div class="relative bg-gradient-to-b from-blue-700 to-blue-900 px-5 pt-10 pb-20 overflow-hidden shadow-sm">
        {{-- Efek cahaya / Orbs background --}}
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-blue-400/20 rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute top-10 right-20 w-20 h-20 bg-white/10 rounded-full blur-xl pointer-events-none"></div>
        <div class="absolute bottom-0 -left-10 w-32 h-32 bg-blue-500/20 rounded-full blur-2xl pointer-events-none"></div>

        <div class="flex flex-col items-center gap-3 relative z-10">

            {{-- Avatar inisial --}}
            <div class="relative group">
                <div class="w-24 h-24 rounded-full bg-white/10 backdrop-blur-sm
                            border-[4px] border-white/30 shadow-lg
                            flex items-center justify-center transition-transform">
                    <span class="text-white text-3xl font-extrabold tracking-tight">
                        {{ strtoupper(substr($masyarakat->nama, 0, 1)) }}{{ strtoupper(substr(explode(' ', $masyarakat->nama)[1] ?? 'X', 0, 1)) }}
                    </span>
                </div>
                {{-- Dot aktif --}}
                <div class="absolute bottom-1 right-1 w-5 h-5
                            bg-green-400 border-4 border-blue-900 rounded-full shadow-sm">
                </div>
            </div>

            <div class="text-center mt-1">
                <h2 class="text-white text-xl font-extrabold tracking-tight drop-shadow-sm">
                    {{ $masyarakat->nama }}
                </h2>
                <p class="text-blue-200/80 text-[11px] font-medium mt-0.5 tracking-wide">
                    {{ $masyarakat->username ?? 'Warga Terdaftar' }}
                </p>
            </div>

            {{-- Pill aktif sejak --}}
            <div class="flex items-center gap-2 bg-white/10 backdrop-blur-md border border-white/10
                        rounded-full px-3.5 py-1.5 mt-1 shadow-sm">
                <svg class="w-3.5 h-3.5 text-blue-300" fill="none"
                     stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2
                           0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="text-white font-medium text-[10px] tracking-wide">
                    Bergabung sejak {{ $masyarakat->created_at->isoFormat('MMMM YYYY') }}
                </span>
            </div>
        </div>
    </div>

    {{-- ── STAT CARDS (float overlap) ─────────────────────────────── --}}
    <div class="grid grid-cols-3 gap-3 px-5 -mt-10 relative z-10">

        <div class="bg-white rounded-3xl p-4 shadow-[0_8px_15px_-3px_rgba(0,0,0,0.08)]
                    border border-gray-100 text-center transform transition-transform">
            <p class="text-2xl font-black text-blue-700 leading-none">
                {{ $stats['total'] }}
            </p>
            <p class="text-gray-400 font-medium text-[10px] mt-2 leading-tight uppercase tracking-wider">
                Total
            </p>
        </div>

        <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-3xl p-4 shadow-[0_8px_15px_-3px_rgba(251,191,36,0.15)]
                    border border-amber-100 text-center transform transition-transform">
            <p class="text-2xl font-black text-amber-600 leading-none">
                {{ $stats['pending'] }}
            </p>
            <p class="text-amber-600/70 font-bold text-[10px] mt-2 leading-tight uppercase tracking-wider">
                Proses
            </p>
        </div>

        <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-3xl p-4 shadow-[0_8px_15px_-3px_rgba(52,211,153,0.15)]
                    border border-green-100 text-center transform transition-transform">
            <p class="text-2xl font-black text-green-600 leading-none">
                {{ $stats['selesai'] }}
            </p>
            <p class="text-green-600/70 font-bold text-[10px] mt-2 leading-tight uppercase tracking-wider">
                Selesai
            </p>
        </div>
    </div>

    {{-- ── INFORMASI AKUN ───────────────────────────────────────────── --}}
    <div class="px-5 mt-8">
        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 ml-2">
            Informasi Akun
        </p>

        <div class="bg-white rounded-3xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.03)] border border-gray-100/80 overflow-hidden">

            {{-- Nama --}}
            <div class="flex items-center gap-3.5 px-5 py-4 border-b border-gray-50/80">
                <div class="w-10 h-10 bg-blue-50/80 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-blue-600" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12
                               14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wide">Nama Lengkap</p>
                    <p class="text-sm font-bold text-gray-800 mt-0.5 truncate">
                        {{ $masyarakat->nama }}
                    </p>
                </div>
            </div>

            {{-- NIK (tidak bisa diubah) --}}
            <div class="flex items-center gap-3.5 px-5 py-4 border-b border-gray-50/80">
                <div class="w-10 h-10 bg-amber-50/80 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-amber-500" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2
                               0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114
                               0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2
                               0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9
                               14a3.001 3.001 0 00-2.83 2"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wide">NIK</p>
                    <p class="text-sm font-mono font-bold text-gray-800 mt-0.5 tracking-widest">
                        {{ implode(' ', str_split($masyarakat->nik, 4)) }}
                    </p>
                </div>
                {{-- Gembok --}}
                <div class="w-7 h-7 bg-gray-50 border border-gray-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2.5"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2
                               0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002
                               2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
            </div>

            {{-- Username --}}
            <div class="flex items-center gap-3.5 px-5 py-4 border-b border-gray-50/80">
                <div class="w-10 h-10 bg-purple-50/80 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-purple-500" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0
                               4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3
                               3 0 016 0z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wide">Username</p>
                    <p class="text-sm font-bold text-gray-800 mt-0.5 truncate">
                        {{ $masyarakat->username ?? '—' }}
                    </p>
                </div>
            </div>

            {{-- Telepon --}}
            <div class="flex items-center gap-3.5 px-5 py-4">
                <div class="w-10 h-10 bg-green-50/80 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-green-500" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498
                               4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042
                               11.042 0 005.516 5.516l1.13-2.257a1 1 0
                               011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2
                               2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wide">No. Telepon</p>
                    <p class="text-sm font-bold text-gray-800 mt-0.5 tracking-wider">
                        {{ $masyarakat->telp
                            ? preg_replace('/(\d{4})(\d{4})(\d+)/', '$1 $2 $3', $masyarakat->telp)
                            : '—' }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Catatan NIK --}}
        <div class="mt-2.5 ml-2 flex items-start gap-1.5 text-[10px] font-medium text-amber-600/80">
            <svg class="w-3.5 h-3.5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75
                       1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646
                       -1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012
                       0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                    clip-rule="evenodd"/>
            </svg>
            <p>Sesuai regulasi keamanan, NIK terhubung secara permanen.</p>
        </div>
    </div>

    {{-- ── MENU PENGATURAN ──────────────────────────────────────────── --}}
    <div class="px-5 mt-7">
        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 ml-2">
            Pengaturan
        </p>

        <div class="bg-white rounded-3xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.03)] border border-gray-100/80 overflow-hidden">

            {{-- Edit Profil --}}
            <a href="{{ route('masyarakat.profile.edit') }}"
                class="flex items-center gap-4 px-5 py-4 border-b border-gray-50/80 
                       active:bg-gray-50 active:scale-[0.98] transition-all group">
                <div class="w-10 h-10 bg-blue-50/80 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-blue-100 transition-colors">
                    <svg class="w-5 h-5 text-blue-600" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5
                               0 113.536 3.536L6.5 21.036H3v-3.572L16.732
                               3.732z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-bold text-gray-800">Edit Profil</p>
                    <p class="text-[11px] font-medium text-gray-400 mt-0.5">
                        Ubah detail informasi kontak Anda
                    </p>
                </div>
                <svg class="w-5 h-5 text-gray-300 group-hover:text-blue-500 group-hover:translate-x-1 transition-all" fill="none"
                     stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </a>

            {{-- Ganti Password --}}
            <a href="{{ route('masyarakat.profile.password') }}"
                class="flex items-center gap-4 px-5 py-4
                       active:bg-gray-50 active:scale-[0.98] transition-all group">
                <div class="w-10 h-10 bg-amber-50/80 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-amber-100 transition-colors">
                    <svg class="w-5 h-5 text-amber-500" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0
                               00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4
                               4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-bold text-gray-800">Ubah Kata Sandi</p>
                    <p class="text-[11px] font-medium text-gray-400 mt-0.5">
                        Tingkatkan keamanan akun Anda secara berkala
                    </p>
                </div>
                <svg class="w-5 h-5 text-gray-300 group-hover:text-amber-500 group-hover:translate-x-1 transition-all" fill="none"
                     stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>

    {{-- ── TOMBOL LOGOUT ────────────────────────────────────────────── --}}
    <div class="px-5 mt-7">
        <form method="POST" action="{{ route('logout') }}" class="block">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-4 px-5 py-4 bg-white rounded-3xl 
                       border border-red-100 shadow-[0_2px_15px_-3px_rgba(239,68,68,0.05)]
                       active:bg-red-50 active:border-red-200 active:scale-[0.98] transition-all text-left group">
                <div class="w-10 h-10 bg-red-50 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-red-100 transition-colors">
                    <svg class="w-5 h-5 text-red-500" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2.5"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0
                               01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3
                               3 0 013 3v1"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-bold text-red-600">Keluar Aplikasi</p>
                    <p class="text-[11px] font-medium text-red-400 mt-0.5">
                        Akhiri sesi dan kembali ke halaman utama
                    </p>
                </div>
            </button>
        </form>
    </div>

    {{-- Versi App --}}
    <p class="text-center font-semibold text-[10px] text-gray-300 mt-8 pb-4 tracking-widest uppercase">
        SiLapor App • Versi 1.0.0
    </p>

</div>
@endsection