@extends('layouts.app')
@section('title', 'Tentang Kami')

@section('content')
<div class="pb-28 bg-gray-50/50 min-h-screen">

    {{-- ═══════════════════════════════════════════════
         HERO SECTION (Modern Gradient + BATIK MEGAMENDUNG)
    ═══════════════════════════════════════════════ --}}
    <div class="relative bg-gradient-to-br from-blue-700 via-blue-800 to-indigo-900 px-5 pt-10 pb-20 overflow-hidden rounded-b-[2rem] shadow-sm">

        {{-- Motif Batik Megamendung --}}
        <div class="absolute inset-0 z-0 opacity-[0.08] mix-blend-overlay pointer-events-none">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="megamendung" x="0" y="0" width="100" height="60" patternUnits="userSpaceOnUse">
                        <path d="M0 60 Q 25 20 50 60 T 100 60" fill="none" stroke="#ffffff" stroke-width="6" stroke-linecap="round"/>
                        <path d="M0 50 Q 25 10 50 50 T 100 50" fill="none" stroke="#ffffff" stroke-width="4" stroke-linecap="round"/>
                        <path d="M0 40 Q 25 0 50 40 T 100 40" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round"/>
                        <path d="M0 30 Q 25 -10 50 30 T 100 30" fill="none" stroke="#ffffff" stroke-width="1" stroke-linecap="round"/>
                    </pattern>
                </defs>
                <rect x="0" y="0" width="100%" height="100%" fill="url(#megamendung)"></rect>
            </svg>
        </div>

        {{-- Dekorasi Cahaya Organik --}}
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-gradient-to-br from-blue-300/30 to-transparent rounded-full blur-2xl pointer-events-none z-0"></div>
        <div class="absolute bottom-0 right-10 w-24 h-24 bg-white/10 rounded-full blur-xl pointer-events-none z-0"></div>
        <div class="absolute -bottom-5 -left-5 w-32 h-32 bg-indigo-500/30 rounded-full blur-2xl pointer-events-none z-0"></div>

        {{-- Judul Halaman --}}
        <div class="relative z-10 flex flex-col items-center justify-center text-center mt-2">
            <div class="w-14 h-14 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 flex items-center justify-center shadow-lg mb-4 transform -rotate-3">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <p class="text-blue-200/90 text-[11px] font-bold tracking-widest uppercase mb-1 drop-shadow-md">
                Informasi Layanan
            </p>
            <h2 class="text-white text-3xl font-extrabold tracking-tight drop-shadow-md">
                Tentang Kami
            </h2>
            <p class="text-blue-100/80 text-xs mt-3 max-w-[250px] mx-auto leading-relaxed">
                Mewujudkan layanan pengaduan masyarakat yang transparan, responsif, dan terpercaya.
            </p>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════
         VISI & MISI (Floating Cards)
    ═══════════════════════════════════════════════ --}}
    <div class="px-5 -mt-10 relative z-20 space-y-4">
        
        {{-- Visi Card --}}
        <div class="bg-white rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-gray-100/80 transition-transform active:scale-[0.98]">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center border border-indigo-100/50">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-black text-gray-900 tracking-tight">Visi Kami</h3>
                    <p class="text-[11px] text-gray-500 font-bold uppercase tracking-wider mt-0.5">Tujuan Utama</p>
                </div>
            </div>
            <p class="text-gray-600 text-sm font-medium leading-relaxed">
                "Menjadi platform layanan aduan publik terdepan yang menjembatani masyarakat dengan pemerintah secara cepat, tepat, dan transparan untuk mewujudkan lingkungan yang lebih baik."
            </p>
        </div>

        {{-- Misi Card --}}
        <div class="bg-white rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-gray-100/80 transition-transform active:scale-[0.98]">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center border border-blue-100/50">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-black text-gray-900 tracking-tight">Misi Kami</h3>
                    <p class="text-[11px] text-gray-500 font-bold uppercase tracking-wider mt-0.5">Langkah Nyata</p>
                </div>
            </div>
            <ul class="space-y-3">
                <li class="flex items-start gap-3 text-sm text-gray-600 font-medium">
                    <div class="mt-0.5 w-5 h-5 rounded-full bg-green-50 flex flex-shrink-0 items-center justify-center border border-green-100">
                        <svg class="w-3 h-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    Memberikan kemudahan akses bagi masyarakat untuk menyampaikan aspirasi.
                </li>
                <li class="flex items-start gap-3 text-sm text-gray-600 font-medium">
                    <div class="mt-0.5 w-5 h-5 rounded-full bg-green-50 flex flex-shrink-0 items-center justify-center border border-green-100">
                        <svg class="w-3 h-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    Merespons dan menindaklanjuti setiap laporan secara profesional.
                </li>
                <li class="flex items-start gap-3 text-sm text-gray-600 font-medium">
                    <div class="mt-0.5 w-5 h-5 rounded-full bg-green-50 flex flex-shrink-0 items-center justify-center border border-green-100">
                        <svg class="w-3 h-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    Menjaga kerahasiaan dan keamanan data pelapor.
                </li>
            </ul>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════
         TUTORIAL PENGGUNAAN (Timeline Style)
    ═══════════════════════════════════════════════ --}}
    <div class="px-5 mt-10">
        <div class="mb-5">
            <h3 class="font-black text-gray-900 text-lg tracking-tight">Cara Melapor</h3>
            <p class="text-xs text-gray-500 mt-0.5 font-medium">4 Langkah mudah menggunakan platform ini</p>
        </div>

        <div class="relative before:absolute before:inset-y-0 before:left-[1.35rem] before:w-0.5 before:bg-gray-100 space-y-6">
            
            {{-- Step 1 --}}
            <div class="relative flex items-start gap-5">
                <div class="w-11 h-11 bg-blue-600 rounded-full flex items-center justify-center shadow-lg shadow-blue-200 z-10 shrink-0 border-4 border-gray-50">
                    <span class="text-white font-black text-sm">1</span>
                </div>
                <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100/80 flex-1">
                    <h4 class="text-sm font-extrabold text-gray-900">Tulis Laporan</h4>
                    <p class="text-xs text-gray-500 font-medium mt-1 leading-relaxed">Sampaikan keluhan atau aspirasi Anda dengan jelas. Sertakan foto bukti agar laporan lebih valid.</p>
                </div>
            </div>

            {{-- Step 2 --}}
            <div class="relative flex items-start gap-5">
                <div class="w-11 h-11 bg-amber-500 rounded-full flex items-center justify-center shadow-lg shadow-amber-200 z-10 shrink-0 border-4 border-gray-50">
                    <span class="text-white font-black text-sm">2</span>
                </div>
                <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100/80 flex-1">
                    <h4 class="text-sm font-extrabold text-gray-900">Proses Verifikasi</h4>
                    <p class="text-xs text-gray-500 font-medium mt-1 leading-relaxed">Admin akan memverifikasi laporan Anda untuk memastikan data valid dan layak ditindaklanjuti.</p>
                </div>
            </div>

            {{-- Step 3 --}}
            <div class="relative flex items-start gap-5">
                <div class="w-11 h-11 bg-indigo-500 rounded-full flex items-center justify-center shadow-lg shadow-indigo-200 z-10 shrink-0 border-4 border-gray-50">
                    <span class="text-white font-black text-sm">3</span>
                </div>
                <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100/80 flex-1">
                    <h4 class="text-sm font-extrabold text-gray-900">Tindak Lanjut</h4>
                    <p class="text-xs text-gray-500 font-medium mt-1 leading-relaxed">Laporan diteruskan ke instansi terkait. Anda bisa melihat progresnya langsung di dashboard.</p>
                </div>
            </div>

            {{-- Step 4 --}}
            <div class="relative flex items-start gap-5">
                <div class="w-11 h-11 bg-green-500 rounded-full flex items-center justify-center shadow-lg shadow-green-200 z-10 shrink-0 border-4 border-gray-50">
                    <span class="text-white font-black text-sm">4</span>
                </div>
                <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100/80 flex-1">
                    <h4 class="text-sm font-extrabold text-gray-900">Selesai</h4>
                    <p class="text-xs text-gray-500 font-medium mt-1 leading-relaxed">Petugas akan memberikan tanggapan akhir setelah masalah di lapangan berhasil diselesaikan.</p>
                </div>
            </div>

        </div>
    </div>

    {{-- ═══════════════════════════════════════════════
         PETA LOKASI KAMI (Google Maps Embed)
    ═══════════════════════════════════════════════ --}}
    <div class="px-5 mt-12">
        <div class="mb-4 flex items-center gap-3">
            <div class="w-10 h-10 bg-red-50 rounded-xl flex items-center justify-center border border-red-100/50">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <div>
                <h3 class="font-black text-gray-900 text-base">Lokasi Instansi</h3>
                <p class="text-[11px] text-gray-500 mt-0.5 font-medium">Temukan kami di peta</p>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-2 shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-gray-100/80">
            <div class="rounded-2xl overflow-hidden relative h-[250px] bg-gray-100 w-full">
                {{-- Embed Google Maps. Sesuaikan src dengan koordinat instansi Anda --}}
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126907.09880193183!2d106.90382373059436!3d-6.284242699318991!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698d8546ad633d%3A0x79e8de8965402078!2sKota%20Bks%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                    class="absolute top-0 left-0 w-full h-full border-0" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            
            <div class="p-4">
                <h4 class="text-sm font-bold text-gray-900">Pusat Layanan Pengaduan</h4>
                <p class="text-xs text-gray-500 mt-1 font-medium leading-relaxed">
                    Jl. Ahmad Yani No. 1, Kota Bekasi, Jawa Barat. Buka setiap hari kerja pukul 08:00 - 16:00 WIB.
                </p>
            </div>
        </div>
    </div>

</div>
@endsection