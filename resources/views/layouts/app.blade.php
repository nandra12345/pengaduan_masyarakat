<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
    <meta name="theme-color" content="#1d4ed8" />
    <title>@yield('title', 'SiLapor')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Padding bawah untuk navigasi mobile */
        .content-area { padding-bottom: 80px; }
        /* Smooth scroll */
        html { scroll-behavior: smooth; }
        /* Animasi fade-in */
        .fade-in { animation: fadeIn 0.3s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">

    {{-- ===== TOP HEADER ===== --}}
    <header class="bg-blue-700 text-white sticky top-0 z-40 shadow-md">
        <div class="flex items-center justify-between px-4 h-14">
            {{-- Tombol Back (jika ada) atau Logo --}}
            <div class="flex items-center gap-3">
                @hasSection('back_url')
                    <a href="@yield('back_url')" class="p-1.5 rounded-lg hover:bg-blue-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                @else
                    <div class="w-7 h-7 bg-white rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                @endif
                <h1 class="font-semibold text-base">@yield('title', 'SiLapor')</h1>
            </div>

            {{-- Info User --}}
            <div class="flex items-center gap-2">
                @auth('masyarakat')
                    <span class="text-xs bg-blue-600 px-2 py-1 rounded-full">
                        {{ Str::limit(auth('masyarakat')->user()->nama, 12) }}
                    </span>
                @endauth
                @auth('petugas')
                    <span class="text-xs px-2 py-1 rounded-full
                        {{ auth('petugas')->user()->level === 'admin'
                            ? 'bg-yellow-400 text-yellow-900'
                            : 'bg-blue-600 text-white' }}">
                        {{ auth('petugas')->user()->level === 'admin' ? 'Admin' : 'Petugas' }}
                    </span>
                @endauth

                {{-- Tombol Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="p-1.5 rounded-lg hover:bg-blue-600 transition"
                        title="Logout">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </header>

    {{-- ===== FLASH MESSAGES ===== --}}
    @if(session('success'))
        <div class="mx-4 mt-3 p-3 bg-green-50 border border-green-200 rounded-xl flex items-start gap-2 fade-in">
            <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <p class="text-green-700 text-sm">{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="mx-4 mt-3 p-3 bg-red-50 border border-red-200 rounded-xl flex items-start gap-2 fade-in">
            <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <p class="text-red-700 text-sm">{{ session('error') }}</p>
        </div>
    @endif

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="content-area fade-in">
        @yield('content')
    </main>

    {{-- ===== BOTTOM NAVIGATION ===== --}}
    {{-- Ganti seluruh blok @auth('masyarakat') nav dengan ini --}}
@auth('masyarakat')
    <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-40 shadow-lg">
        <div class="flex">

            {{-- Beranda --}}
            <a href="{{ route('masyarakat.dashboard') }}"
                class="flex-1 flex flex-col items-center py-2 gap-0.5 transition
                    {{ request()->routeIs('masyarakat.dashboard')
                        ? 'text-blue-700' : 'text-gray-400' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2
                           m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1
                           0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="text-[10px] font-medium">Beranda</span>
            </a>

            {{-- Laporan --}}
            <a href="{{ route('masyarakat.pengaduan.index') }}"
                class="flex-1 flex flex-col items-center py-2 gap-0.5 transition
                    {{ request()->routeIs('masyarakat.pengaduan.index')
                        ? 'text-blue-700' : 'text-gray-400' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0
                           002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0
                           002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <span class="text-[10px] font-medium">Laporan</span>
            </a>

            {{-- FAB Buat Laporan --}}
            <a href="{{ route('masyarakat.pengaduan.create') }}"
                class="flex-1 flex flex-col items-center py-2 gap-0.5">
                <div class="w-11 h-11 bg-blue-700 rounded-full flex items-center
                            justify-center -mt-5 shadow-lg border-4 border-gray-50
                            {{ request()->routeIs('masyarakat.pengaduan.create')
                                ? 'ring-2 ring-blue-300' : '' }}">
                    <svg class="w-5 h-5 text-white" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <span class="text-[10px] font-medium text-gray-400">Buat Laporan</span>
            </a>

            {{-- Profil --}}
            <a href="{{ route('masyarakat.profile.index') }}"
                class="flex-1 flex flex-col items-center py-2 gap-0.5 transition
                    {{ request()->routeIs('masyarakat.profile.*')
                        ? 'text-blue-700' : 'text-gray-400' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12
                           14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span class="text-[10px] font-medium">Profil</span>
            </a>

        </div>
    </nav>
@endauth

    @auth('petugas')
        <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-40 shadow-lg">
            <div class="flex">
                <a href="{{ route('petugas.dashboard') }}"
                    class="flex-1 flex flex-col items-center py-2 gap-0.5 transition
                        {{ request()->routeIs('petugas.dashboard') ? 'text-blue-700' : 'text-gray-500' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span class="text-xs font-medium">Beranda</span>
                </a>
                <a href="{{ route('petugas.pengaduan.index') }}"
                    class="flex-1 flex flex-col items-center py-2 gap-0.5 transition
                        {{ request()->routeIs('petugas.pengaduan.*') ? 'text-blue-700' : 'text-gray-500' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <span class="text-xs font-medium">Pengaduan</span>
                </a>
                @if(auth('petugas')->user()->isAdmin())
                <a href="{{ route('admin.laporan.index') }}"
                    class="flex-1 flex flex-col items-center py-2 gap-0.5 transition
                        {{ request()->routeIs('admin.laporan.*') ? 'text-yellow-600' : 'text-gray-500' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span class="text-xs font-medium">Rekap</span>
                </a>
                <a href="{{ route('admin.petugas.index') }}"
                    class="flex-1 flex flex-col items-center py-2 gap-0.5 transition
                        {{ request()->routeIs('admin.petugas.*') ? 'text-yellow-600' : 'text-gray-500' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <span class="text-xs font-medium">Petugas</span>
                </a>
                @endif
            </div>
        </nav>
    @endauth

</body>
</html>