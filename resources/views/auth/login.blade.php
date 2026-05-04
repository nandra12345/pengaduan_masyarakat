@extends('layouts.guest')
@section('title', 'Masuk')

@section('content')

    <h2 class="text-lg font-bold text-gray-800 mb-0.5">Selamat Datang </h2>
    <p class="text-gray-400 text-xs mb-5">Masuk untuk melanjutkan ke sistem</p>

    {{-- ── Flash Error ──────────────────────────────────────────────── --}}
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-2xl
                    text-red-600 text-sm flex items-start gap-2">
            <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="currentColor"
                 viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2
                       0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1
                       1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-50 border border-green-200 rounded-2xl
                    text-green-700 text-sm flex items-start gap-2">
            <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="currentColor"
                 viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0
                       00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414
                       1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
        @csrf

        {{-- ── Username ─────────────────────────────────────────────── --}}
        <div class="space-y-1.5">
            <label class="block text-xs font-semibold text-gray-600 uppercase
                          tracking-wider">
                Username
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center
                             pl-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12
                               14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </span>
                <input type="text"
                    name="username"
                    value="{{ old('username') }}"
                    placeholder="Masukkan username"
                    autocomplete="username"
                    class="w-full pl-10 pr-4 py-3 text-sm border rounded-xl
                           focus:outline-none focus:ring-2 focus:ring-blue-500
                           focus:border-transparent focus:bg-white transition
                           {{ $errors->has('username')
                               ? 'border-red-400 bg-red-50'
                               : 'border-gray-200 bg-gray-50' }}" />
            </div>
            @error('username')
                <p class="text-red-500 text-xs flex items-center gap-1">
                    <svg class="w-3 h-3 flex-shrink-0" fill="currentColor"
                         viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1
                               0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1
                               1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- ── Password ─────────────────────────────────────────────── --}}
        <div class="space-y-1.5">
            <label class="block text-xs font-semibold text-gray-600 uppercase
                          tracking-wider">
                Password
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center
                             pl-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0
                               00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4
                               4 0 00-8 0v4h8z"/>
                    </svg>
                </span>
                <input type="password"
                    name="password"
                    id="passwordInput"
                    placeholder="Masukkan password"
                    autocomplete="current-password"
                    class="w-full pl-10 pr-10 py-3 text-sm border rounded-xl
                           focus:outline-none focus:ring-2 focus:ring-blue-500
                           focus:border-transparent focus:bg-white transition
                           {{ $errors->has('password')
                               ? 'border-red-400 bg-red-50'
                               : 'border-gray-200 bg-gray-50' }}" />
                <button type="button"
                    onclick="togglePassword()"
                    class="absolute inset-y-0 right-0 flex items-center
                           pr-3.5 text-gray-400 hover:text-gray-600 transition">
                    <svg id="eyeIconShow" class="w-4 h-4" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478
                               0 8.268 2.943 9.542 7-1.274 4.057-5.064
                               7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg id="eyeIconHide" class="w-4 h-4 hidden" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478
                               0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029
                               m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242
                               4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29
                               M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478
                               0 8.268 2.943 9.543 7a10.025 10.025 0
                               01-4.132 5.411m0 0L21 21"/>
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="text-red-500 text-xs flex items-center gap-1">
                    <svg class="w-3 h-3 flex-shrink-0" fill="currentColor"
                         viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1
                               0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1
                               1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- ── Remember Me ──────────────────────────────────────────── --}}
        <div class="flex items-center gap-2">
            <input type="checkbox"
                name="remember"
                id="remember"
                class="w-4 h-4 rounded border-gray-300 text-blue-700
                       focus:ring-blue-500 cursor-pointer" />
            <label for="remember"
                class="text-sm text-gray-500 cursor-pointer select-none">
                Ingat saya
            </label>
        </div>

        {{-- ── Tombol Login ─────────────────────────────────────────── --}}
        <button type="submit"
            id="btnLogin"
            class="w-full bg-blue-800 hover:bg-blue-900 active:scale-95
                   text-white font-semibold py-3.5 rounded-2xl transition
                   duration-200 text-sm shadow-md flex items-center
                   justify-center gap-2">
            <svg id="loginSpinner"
                class="hidden w-4 h-4 animate-spin text-white"
                fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10"
                    stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
            </svg>
            <span id="loginText">Masuk</span>
        </button>

        {{-- ── Divider ──────────────────────────────────────────────── --}}
        <div class="flex items-center gap-3 py-1">
            <div class="flex-1 h-px bg-gray-100"></div>
            <span class="text-[11px] text-gray-400">atau</span>
            <div class="flex-1 h-px bg-gray-100"></div>
        </div>

        {{-- ── Link Register ────────────────────────────────────────── --}}
        <a href="{{ route('register') }}"
            class="flex items-center justify-center gap-2 w-full
                   border border-gray-200 bg-gray-50 hover:bg-gray-100
                   active:scale-95 text-gray-700 font-semibold
                   py-3 rounded-2xl transition text-sm">
            <svg class="w-4 h-4 text-gray-500" fill="none"
                 stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2"
                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4
                       0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
            Daftar Akun Baru
        </a>

    </form>

    <script>
        // ── Toggle visibility password ───────────────────────────────
        function togglePassword() {
            const input   = document.getElementById('passwordInput');
            const iconShow = document.getElementById('eyeIconShow');
            const iconHide = document.getElementById('eyeIconHide');

            if (input.type === 'password') {
                input.type = 'text';
                iconShow.classList.add('hidden');
                iconHide.classList.remove('hidden');
            } else {
                input.type = 'password';
                iconShow.classList.remove('hidden');
                iconHide.classList.add('hidden');
            }
        }

        // ── Loading state saat form submit ───────────────────────────
        document.querySelector('form').addEventListener('submit', function () {
            const btn     = document.getElementById('btnLogin');
            const spinner = document.getElementById('loginSpinner');
            const text    = document.getElementById('loginText');

            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');
            spinner.classList.remove('hidden');
            text.textContent = 'Memproses...';
        });
    </script>
@endsection