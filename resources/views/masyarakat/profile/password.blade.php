@extends('layouts.app')
@section('title', 'Ganti Password')
@section('back_url', route('masyarakat.profile.index'))

@section('content')
<div class="px-4 pt-5 pb-10">

    {{-- Info Banner --}}
    <div class="flex gap-3 bg-amber-50 border border-amber-100
                rounded-2xl p-3.5 mb-6">
        <div class="w-7 h-7 bg-amber-100 rounded-full flex items-center
                    justify-center flex-shrink-0 mt-0.5">
            <svg class="w-3.5 h-3.5 text-amber-600" fill="none"
                 stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667
                       1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34
                       16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </div>
        <p class="text-xs text-amber-800 leading-relaxed">
            Setelah password berhasil diubah, Anda akan
            <strong>otomatis logout</strong> dan diminta login kembali
            dengan password baru.
        </p>
    </div>

    <form method="POST"
          action="{{ route('masyarakat.profile.password.update') }}"
          class="space-y-4">
        @csrf
        @method('PUT')

        {{-- Password Lama --}}
        <div class="space-y-1.5">
            <label class="block text-sm font-semibold text-gray-700">
                Password Lama <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center
                             pl-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0
                               00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4
                               4 0 00-8 0v4h8z"/>
                    </svg>
                </span>
                <input type="password" name="password_lama"
                    id="passLama"
                    placeholder="Masukkan password saat ini"
                    class="w-full pl-10 pr-10 py-3 text-sm border rounded-xl
                           bg-gray-50 focus:outline-none focus:ring-2
                           focus:ring-blue-500 focus:bg-white transition
                           {{ $errors->has('password_lama')
                               ? 'border-red-400 bg-red-50'
                               : 'border-gray-200' }}" />
                <button type="button"
                    onclick="togglePass('passLama', 'eyeLama')"
                    class="absolute inset-y-0 right-0 flex items-center
                           pr-3.5 text-gray-400">
                    <svg id="eyeLama" class="w-4 h-4" fill="none"
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
                </button>
            </div>
            @error('password_lama')
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

        {{-- Garis Pemisah --}}
        <div class="flex items-center gap-2 py-1">
            <div class="flex-1 h-px bg-gray-100"></div>
            <span class="text-[10px] text-gray-400 uppercase tracking-wider">
                Password Baru
            </span>
            <div class="flex-1 h-px bg-gray-100"></div>
        </div>

        {{-- Password Baru --}}
        <div class="space-y-1.5">
            <label class="block text-sm font-semibold text-gray-700">
                Password Baru <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center
                             pl-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0
                               0112 2.944a11.955 11.955 0 01-8.618
                               3.04A12.02 12.02 0 003 9c0 5.591 3.824
                               10.29 9 11.622 5.176-1.332 9-6.03
                               9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </span>
                <input type="password" name="password"
                    id="passBaru"
                    placeholder="Minimal 6 karakter"
                    oninput="cekKekuatanPassword(this.value)"
                    class="w-full pl-10 pr-10 py-3 text-sm border rounded-xl
                           bg-gray-50 focus:outline-none focus:ring-2
                           focus:ring-blue-500 focus:bg-white transition
                           {{ $errors->has('password')
                               ? 'border-red-400 bg-red-50'
                               : 'border-gray-200' }}" />
                <button type="button"
                    onclick="togglePass('passBaru', 'eyeBaru')"
                    class="absolute inset-y-0 right-0 flex items-center
                           pr-3.5 text-gray-400">
                    <svg id="eyeBaru" class="w-4 h-4" fill="none"
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
                </button>
            </div>

            {{-- Indikator kekuatan password --}}
            <div id="strengthBar" class="hidden mt-2">
                <div class="flex gap-1 mb-1">
                    <div id="s1" class="h-1 flex-1 rounded-full bg-gray-200"></div>
                    <div id="s2" class="h-1 flex-1 rounded-full bg-gray-200"></div>
                    <div id="s3" class="h-1 flex-1 rounded-full bg-gray-200"></div>
                    <div id="s4" class="h-1 flex-1 rounded-full bg-gray-200"></div>
                </div>
                <p id="strengthLabel"
                   class="text-[11px] text-gray-400"></p>
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

        {{-- Konfirmasi Password Baru --}}
        <div class="space-y-1.5">
            <label class="block text-sm font-semibold text-gray-700">
                Konfirmasi Password Baru <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center
                             pl-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0
                               0112 2.944a11.955 11.955 0 01-8.618
                               3.04A12.02 12.02 0 003 9c0 5.591 3.824
                               10.29 9 11.622 5.176-1.332 9-6.03
                               9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </span>
                <input type="password" name="password_confirmation"
                    id="passKonfirm"
                    placeholder="Ulangi password baru"
                    oninput="cekKonfirmasi()"
                    class="w-full pl-10 pr-10 py-3 text-sm border rounded-xl
                           bg-gray-50 focus:outline-none focus:ring-2
                           focus:ring-blue-500 focus:bg-white transition
                           border-gray-200" />
                <div id="matchIcon"
                     class="absolute inset-y-0 right-0 flex items-center
                            pr-3.5 hidden">
                </div>
            </div>
            <p id="matchMsg" class="text-[11px] hidden"></p>
        </div>

        {{-- Tombol --}}
        <div class="pt-2 space-y-2">
            <button type="submit"
                class="w-full bg-amber-600 hover:bg-amber-700 active:scale-95
                       text-white font-semibold py-3.5 rounded-2xl transition
                       shadow-md text-sm">
                Ubah Password
            </button>
            <a href="{{ route('masyarakat.profile.index') }}"
                class="block text-center text-sm text-gray-500 py-2.5
                       rounded-xl hover:bg-gray-100 transition">
                Batal
            </a>
        </div>
    </form>
</div>

<script>
    function togglePass(inputId, iconId) {
        const input = document.getElementById(inputId);
        input.type  = input.type === 'password' ? 'text' : 'password';
    }

    function cekKekuatanPassword(val) {
        const bar   = document.getElementById('strengthBar');
        const segs  = ['s1','s2','s3','s4'];
        const label = document.getElementById('strengthLabel');

        if (!val) { bar.classList.add('hidden'); return; }
        bar.classList.remove('hidden');

        let score = 0;
        if (val.length >= 6)  score++;
        if (val.length >= 10) score++;
        if (/[A-Z]/.test(val) && /[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;

        const configs = [
            { color: 'bg-red-400',    text: 'Lemah',       textColor: 'text-red-500' },
            { color: 'bg-amber-400',  text: 'Cukup',       textColor: 'text-amber-500' },
            { color: 'bg-blue-400',   text: 'Kuat',        textColor: 'text-blue-500' },
            { color: 'bg-green-400',  text: 'Sangat kuat', textColor: 'text-green-600' },
        ];

        segs.forEach((id, i) => {
            const el = document.getElementById(id);
            el.className = 'h-1 flex-1 rounded-full ' +
                (i < score ? configs[score - 1].color : 'bg-gray-200');
        });

        label.textContent  = configs[score - 1]?.text ?? '';
        label.className    = 'text-[11px] ' + (configs[score - 1]?.textColor ?? '');
    }

    function cekKonfirmasi() {
        const baru    = document.getElementById('passBaru').value;
        const konfirm = document.getElementById('passKonfirm').value;
        const msg     = document.getElementById('matchMsg');
        const icon    = document.getElementById('matchIcon');

        if (!konfirm) {
            msg.classList.add('hidden');
            icon.classList.add('hidden');
            return;
        }

        if (baru === konfirm) {
            msg.textContent  = '✓ Password cocok';
            msg.className    = 'text-[11px] text-green-600';
            msg.classList.remove('hidden');
        } else {
            msg.textContent  = '✗ Password tidak cocok';
            msg.className    = 'text-[11px] text-red-500';
            msg.classList.remove('hidden');
        }
    }
</script>
@endsection