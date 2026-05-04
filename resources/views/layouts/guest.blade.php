<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#1e3a8a" />
    <title>@yield('title', 'SiLapor') — Sistem Pengaduan Masyarakat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
          rel="stylesheet" />
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-blue-900 flex items-start justify-center">

    {{-- ── Corak Batik Mega Mendung (SVG full-page background) ─────── --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <svg class="w-full h-full opacity-[0.12]"
             viewBox="0 0 800 600"
             xmlns="http://www.w3.org/2000/svg"
             preserveAspectRatio="xMidYMid slice">
            <defs>
                <style>
                    .mm { fill: none; stroke: white; stroke-linecap: round; }
                    .mm-lg { stroke-width: 1.8; }
                    .mm-md { stroke-width: 1.4; }
                    .mm-sm { stroke-width: 1.0; }
                </style>
            </defs>

            {{-- Grup awan baris 1 --}}
            <g>
                <path class="mm mm-lg" d="M-30,35 Q0,0  30,35 Q60,70  90,35 Q120,0  150,35 Q180,70 210,35 Q240,0  270,35 Q300,70 330,35 Q360,0  390,35 Q420,70 450,35 Q480,0  510,35 Q540,70 570,35 Q600,0  630,35 Q660,70 690,35 Q720,0  750,35 Q780,70 810,35"/>
                <path class="mm mm-md" d="M-30,52 Q0,20  30,52 Q60,84  90,52 Q120,20 150,52 Q180,84 210,52 Q240,20 270,52 Q300,84 330,52 Q360,20 390,52 Q420,84 450,52 Q480,20 510,52 Q540,84 570,52 Q600,20 630,52 Q660,84 690,52 Q720,20 750,52 Q780,84 810,52"/>
                <path class="mm mm-md" d="M-30,66 Q0,38  30,66 Q60,94  90,66 Q120,38 150,66 Q180,94 210,66 Q240,38 270,66 Q300,94 330,66 Q360,38 390,66 Q420,94 450,66 Q480,38 510,66 Q540,94 570,66 Q600,38 630,66 Q660,94 690,66 Q720,38 750,66 Q780,94 810,66"/>
                <path class="mm mm-sm" d="M-30,78 Q0,54  30,78 Q60,102 90,78 Q120,54 150,78 Q180,102 210,78 Q240,54 270,78 Q300,102 330,78 Q360,54 390,78 Q420,102 450,78 Q480,54 510,78 Q540,102 570,78 Q600,54 630,78 Q660,102 690,78 Q720,54 750,78 Q780,102 810,78"/>
                <path class="mm mm-sm" d="M-30,88 Q0,67  30,88 Q60,109 90,88 Q120,67 150,88 Q180,109 210,88 Q240,67 270,88 Q300,109 330,88 Q360,67 390,88 Q420,109 450,88 Q480,67 510,88 Q540,109 570,88 Q600,67 630,88 Q660,109 690,88 Q720,67 750,88 Q780,109 810,88"/>
            </g>

            {{-- Grup awan baris 2 --}}
            <g>
                <path class="mm mm-lg" d="M-30,155 Q0,120 30,155 Q60,190 90,155 Q120,120 150,155 Q180,190 210,155 Q240,120 270,155 Q300,190 330,155 Q360,120 390,155 Q420,190 450,155 Q480,120 510,155 Q540,190 570,155 Q600,120 630,155 Q660,190 690,155 Q720,120 750,155 Q780,190 810,155"/>
                <path class="mm mm-md" d="M-30,172 Q0,140 30,172 Q60,204 90,172 Q120,140 150,172 Q180,204 210,172 Q240,140 270,172 Q300,204 330,172 Q360,140 390,172 Q420,204 450,172 Q480,140 510,172 Q540,204 570,172 Q600,140 630,172 Q660,204 690,172 Q720,140 750,172 Q780,204 810,172"/>
                <path class="mm mm-md" d="M-30,186 Q0,158 30,186 Q60,214 90,186 Q120,158 150,186 Q180,214 210,186 Q240,158 270,186 Q300,214 330,186 Q360,158 390,186 Q420,214 450,186 Q480,158 510,186 Q540,214 570,186 Q600,158 630,186 Q660,214 690,186 Q720,158 750,186 Q780,214 810,186"/>
                <path class="mm mm-sm" d="M-30,198 Q0,174 30,198 Q60,222 90,198 Q120,174 150,198 Q180,222 210,198 Q240,174 270,198 Q300,222 330,198 Q360,174 390,198 Q420,222 450,198 Q480,174 510,198 Q540,222 570,198 Q600,174 630,198 Q660,222 690,198 Q720,174 750,198 Q780,222 810,198"/>
                <path class="mm mm-sm" d="M-30,208 Q0,187 30,208 Q60,229 90,208 Q120,187 150,208 Q180,229 210,208 Q240,187 270,208 Q300,229 330,208 Q360,187 390,208 Q420,229 450,208 Q480,187 510,208 Q540,229 570,208 Q600,187 630,208 Q660,229 690,208 Q720,187 750,208 Q780,229 810,208"/>
            </g>

            {{-- Grup awan baris 3 --}}
            <g>
                <path class="mm mm-lg" d="M-30,275 Q0,240 30,275 Q60,310 90,275 Q120,240 150,275 Q180,310 210,275 Q240,240 270,275 Q300,310 330,275 Q360,240 390,275 Q420,310 450,275 Q480,240 510,275 Q540,310 570,275 Q600,240 630,275 Q660,310 690,275 Q720,240 750,275 Q780,310 810,275"/>
                <path class="mm mm-md" d="M-30,292 Q0,260 30,292 Q60,324 90,292 Q120,260 150,292 Q180,324 210,292 Q240,260 270,292 Q300,324 330,292 Q360,260 390,292 Q420,324 450,292 Q480,260 510,292 Q540,324 570,292 Q600,260 630,292 Q660,324 690,292 Q720,260 750,292 Q780,324 810,292"/>
                <path class="mm mm-md" d="M-30,306 Q0,278 30,306 Q60,334 90,306 Q120,278 150,306 Q180,334 210,306 Q240,278 270,306 Q300,334 330,306 Q360,278 390,306 Q420,334 450,306 Q480,278 510,306 Q540,334 570,306 Q600,278 630,306 Q660,334 690,306 Q720,278 750,306 Q780,334 810,306"/>
                <path class="mm mm-sm" d="M-30,318 Q0,294 30,318 Q60,342 90,318 Q120,294 150,318 Q180,342 210,318 Q240,294 270,318 Q300,342 330,318 Q360,294 390,318 Q420,342 450,318 Q480,294 510,318 Q540,342 570,318 Q600,294 630,318 Q660,342 690,318 Q720,294 750,318 Q780,342 810,318"/>
            </g>

            {{-- Grup awan baris 4 --}}
            <g>
                <path class="mm mm-lg" d="M-30,395 Q0,360 30,395 Q60,430 90,395 Q120,360 150,395 Q180,430 210,395 Q240,360 270,395 Q300,430 330,395 Q360,360 390,395 Q420,430 450,395 Q480,360 510,395 Q540,430 570,395 Q600,360 630,395 Q660,430 690,395 Q720,360 750,395 Q780,430 810,395"/>
                <path class="mm mm-md" d="M-30,412 Q0,380 30,412 Q60,444 90,412 Q120,380 150,412 Q180,444 210,412 Q240,380 270,412 Q300,444 330,412 Q360,380 390,412 Q420,444 450,412 Q480,380 510,412 Q540,444 570,412 Q600,380 630,412 Q660,444 690,412 Q720,380 750,412 Q780,444 810,412"/>
                <path class="mm mm-md" d="M-30,426 Q0,398 30,426 Q60,454 90,426 Q120,398 150,426 Q180,454 210,426 Q240,398 270,426 Q300,454 330,426 Q360,398 390,426 Q420,454 450,426 Q480,398 510,426 Q540,454 570,426 Q600,398 630,426 Q660,454 690,426 Q720,398 750,426 Q780,454 810,426"/>
                <path class="mm mm-sm" d="M-30,438 Q0,414 30,438 Q60,462 90,438 Q120,414 150,438 Q180,462 210,438 Q240,414 270,438 Q300,462 330,438 Q360,414 390,438 Q420,462 450,438 Q480,414 510,438 Q540,462 570,438 Q600,414 630,438 Q660,462 690,438 Q720,414 750,438 Q780,462 810,438"/>
            </g>

            {{-- Grup awan baris 5 --}}
            <g>
                <path class="mm mm-lg" d="M-30,515 Q0,480 30,515 Q60,550 90,515 Q120,480 150,515 Q180,550 210,515 Q240,480 270,515 Q300,550 330,515 Q360,480 390,515 Q420,550 450,515 Q480,480 510,515 Q540,550 570,515 Q600,480 630,515 Q660,550 690,515 Q720,480 750,515 Q780,550 810,515"/>
                <path class="mm mm-md" d="M-30,532 Q0,500 30,532 Q60,564 90,532 Q120,500 150,532 Q180,564 210,532 Q240,500 270,532 Q300,564 330,532 Q360,500 390,532 Q420,564 450,532 Q480,500 510,532 Q540,564 570,532 Q600,500 630,532 Q660,564 690,532 Q720,500 750,532 Q780,564 810,532"/>
                <path class="mm mm-sm" d="M-30,546 Q0,518 30,546 Q60,574 90,546 Q120,518 150,546 Q180,574 210,546 Q240,518 270,546 Q300,574 330,546 Q360,518 390,546 Q420,574 450,546 Q480,518 510,546 Q540,574 570,546 Q600,518 630,546 Q660,574 690,546 Q720,518 750,546 Q780,574 810,546"/>
            </g>
        </svg>
    </div>

    {{-- ── Konten Utama ─────────────────────────────────────────────── --}}
    <div class="relative z-10 w-full min-h-screen flex flex-col
                items-center justify-start pt-0 pb-8">

        {{-- Area Header + Logo Instansi --}}
        <div class="w-full max-w-md px-0">
            <div class="flex flex-col items-center gap-3 pt-10 pb-10 px-6">

                {{-- ═══════════════════════════════════════════════════════
                     LOGO INSTANSI
                     Ganti <img> src dengan path logo instansi Anda.
                     Contoh: src="{{ asset('images/logo-instansi.png') }}"
                ════════════════════════════════════════════════════════ --}}
                <div class="w-20 h-20 rounded-full bg-white
                            border-4 border-white/30 shadow-lg
                            flex items-center justify-center overflow-hidden">
                    {{-- Jika sudah ada file logo, gunakan tag <img> di bawah: --}}
                    {{-- <img src="{{ asset('images/logo-instansi.png') }}"
                             alt="Logo Instansi"
                             class="w-16 h-16 object-contain" /> --}}

                    {{-- Placeholder logo (hapus jika sudah pakai <img>) --}}
                   {{-- Hapus SVG placeholder, gunakan ini: --}}
                    <img src="{{ asset('images/logo-instansi.png') }}"
                        alt="Logo Instansi"
                        class="w-16 h-16 object-contain" />
                                    </div>

                {{-- Nama Sistem --}}
                <div class="text-center">
                    <h1 class="text-white text-xl font-bold tracking-tight">
                        SiLapor
                    </h1>
                    <p class="text-blue-200 text-xs mt-0.5 leading-relaxed">
                        Sistem Informasi Pengaduan Masyarakat
                    </p>
                </div>
            </div>
        </div>

        {{-- ── Card Form ─────────────────────────────────────────────── --}}
        <div class="w-full max-w-md px-4">
            <div class="bg-white rounded-3xl shadow-2xl px-6 py-7">
                @yield('content')
            </div>

            <p class="text-center text-blue-200/60 text-xs mt-5">
                © {{ date('Y') }} SiLapor. Hak Cipta Dilindungi.
            </p>
        </div>
    </div>

</body>
</html>