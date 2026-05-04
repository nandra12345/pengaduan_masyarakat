@extends('layouts.app')
@section('title', 'Buat Laporan')
@section('back_url', route('masyarakat.dashboard'))

@section('content')
<div class="px-5 pt-6 pb-12 bg-white min-h-screen">

    {{-- Step Indicator (Modern Progress) --}}
    <div class="mb-6">
        <div class="flex items-center justify-between mb-2">
            <p class="text-[11px] font-black text-blue-600 uppercase tracking-widest">Langkah 1</p>
            <span class="text-[11px] font-semibold text-gray-400">Isi Laporan</span>
        </div>
        <div class="h-1.5 flex w-full bg-gray-100 rounded-full overflow-hidden">
            <div class="w-1/2 bg-gradient-to-r from-blue-500 to-blue-700 rounded-full"></div>
        </div>
    </div>

    {{-- Info Banner (Glass Effect) --}}
    <div class="flex items-start gap-3 bg-blue-50/80 backdrop-blur-sm border border-blue-100/50 rounded-2xl p-4 mb-7 shadow-[0_2px_10px_-3px_rgba(37,99,235,0.1)]">
        <div class="flex-shrink-0 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-sm text-blue-600 mt-0.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <p class="text-xs text-blue-900 leading-relaxed">
            Sertakan <span class="font-extrabold text-blue-700">lokasi kejadian</span> dan <span class="font-extrabold text-blue-700">waktu</span>
            agar laporan dapat diproses lebih cepat dan akurat.
        </p>
    </div>

    <form method="POST"
          action="{{ route('masyarakat.pengaduan.store') }}"
          enctype="multipart/form-data"
          id="formLaporan"
          class="space-y-6">
        @csrf

        {{-- ── ISIAN LAPORAN ───────────────────────────────────────── --}}
        <div class="space-y-2">
            <label for="isi_laporan" class="block text-sm font-extrabold text-gray-800">
                Deskripsi Laporan
                <span class="text-red-500">*</span>
            </label>

            <div class="relative group">
                <textarea
                    id="isi_laporan"
                    name="isi_laporan"
                    rows="6"
                    maxlength="500"
                    placeholder="Ceritakan detail masalahnya di sini. Contoh: Jalan berlubang cukup dalam di Jl. Merdeka No. 5, membahayakan pengendara motor..."
                    oninput="hitungKarakter(this)"
                    class="w-full px-4 py-3.5 text-sm bg-gray-50/50 border rounded-2xl
                           focus:outline-none focus:ring-4 focus:ring-blue-500/10
                           focus:bg-white resize-none transition-all duration-200
                           {{ $errors->has('isi_laporan')
                               ? 'border-red-300 focus:border-red-500 shadow-[0_0_0_4px_rgba(239,68,68,0.1)]'
                               : 'border-gray-200 focus:border-blue-500 shadow-sm' }}"
                >{{ old('isi_laporan') }}</textarea>

                {{-- Badge counter karakter (Floating) --}}
                <span id="charCounter"
                    class="absolute bottom-3 right-3 text-[10px] font-bold text-gray-400
                           bg-white/90 backdrop-blur px-2 py-1 rounded-lg border border-gray-100 shadow-sm transition-colors">
                    0 / 500
                </span>
            </div>

            @error('isi_laporan')
                <p class="flex items-center gap-1.5 text-red-500 text-xs font-semibold mt-1">
                    <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
            @else
                <p class="text-[11px] text-gray-400 font-medium px-1">Minimal 20 karakter</p>
            @enderror
        </div>

        {{-- ── FOTO PENDUKUNG ──────────────────────────────────────── --}}
        <div class="space-y-2">
            <div class="flex items-center justify-between">
                <label class="block text-sm font-extrabold text-gray-800">
                    Foto Bukti
                    <span class="text-[11px] font-semibold text-gray-400 ml-1 bg-gray-100 px-2 py-0.5 rounded-md">Opsional</span>
                </label>
                {{-- Tombol hapus foto --}}
                <button type="button"
                    id="btnHapusFoto"
                    onclick="hapusFoto()"
                    class="hidden text-[11px] text-red-600 font-bold bg-red-50 hover:bg-red-100 px-2.5 py-1 rounded-md transition-colors">
                    Hapus Foto
                </button>
            </div>

            {{-- Area Upload --}}
            <label for="fotoInput"
                id="uploadArea"
                class="relative flex flex-col items-center justify-center w-full
                       border-2 border-dashed rounded-3xl cursor-pointer
                       transition-all duration-200 overflow-hidden group
                       {{ $errors->has('foto')
                           ? 'border-red-300 bg-red-50/50 h-32'
                           : 'border-gray-300 bg-gray-50/50 hover:border-blue-400 hover:bg-blue-50/30 h-32' }}">

                {{-- Placeholder --}}
                <div id="uploadPlaceholder" class="flex flex-col items-center gap-2 py-4 transform group-hover:scale-105 transition-transform duration-300">
                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm border border-gray-100 group-hover:border-blue-200 group-hover:shadow-blue-100 transition-all">
                        <svg class="w-6 h-6 text-gray-400 group-hover:text-blue-500 transition-colors" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16
                                   m-2-2l1.586-1.586a2 2 0 012.828 0L20 14
                                   m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0
                                   00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="text-center">
                        <p class="text-sm font-bold text-gray-700">Pilih dari Galeri</p>
                        <p class="text-[10px] font-medium text-gray-400 mt-0.5">Format JPG/PNG, maks. 2MB</p>
                    </div>
                </div>

                {{-- Preview Foto --}}
                <img id="previewImg" src="" alt="Preview foto"
                    class="hidden absolute inset-0 w-full h-full object-cover z-10" />
                
                {{-- Overlay tipis saat foto terisi agar tombol hapus terlihat natural jika ada di dalam (opsional, tp kita ikuti struktur aslinya) --}}
            </label>

            {{-- Input file tersembunyi --}}
            <input type="file"
                name="foto"
                id="fotoInput"
                accept="image/jpg,image/jpeg,image/png"
                class="hidden"
                onchange="previewFoto(this)" />

            {{-- Divider --}}
            <div class="flex items-center gap-3 py-1">
                <div class="flex-1 h-px bg-gray-100"></div>
                <span class="text-[10px] font-bold text-gray-300 uppercase tracking-widest">Atau</span>
                <div class="flex-1 h-px bg-gray-100"></div>
            </div>

            {{-- Tombol Buka Kamera --}}
            <button type="button"
                onclick="bukaKamera()"
                class="w-full flex items-center justify-center gap-2.5
                       bg-white border-2 border-gray-100 rounded-2xl
                       py-3.5 text-sm text-gray-700 font-bold shadow-sm
                       hover:bg-gray-50 hover:border-gray-200 active:scale-[0.98] transition-all">
                <svg class="w-5 h-5 text-gray-500" fill="none"
                     stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2
                           2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2
                           0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2
                           0 01-2-2V9z"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Ambil Langsung via Kamera
            </button>

            {{-- Input kamera tersembunyi --}}
            <input type="file"
                id="kameraInput"
                accept="image/*"
                capture="environment"
                class="hidden"
                onchange="previewFoto(this, true)" />

            @error('foto')
                <p class="flex items-center gap-1.5 text-red-500 text-xs font-semibold mt-1">
                    <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1
                               1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1
                               1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- ── TOMBOL AKSI ─────────────────────────────────────────── --}}
        <div class="pt-6 space-y-3">
            <button type="submit"
                id="btnKirim"
                class="w-full flex items-center justify-center gap-2
                       bg-gradient-to-r from-blue-600 to-blue-700 
                       hover:from-blue-700 hover:to-blue-800 
                       active:scale-[0.98] text-white font-bold py-4 rounded-2xl
                       transition-all duration-200 shadow-[0_8px_20px_-6px_rgba(37,99,235,0.4)] text-sm tracking-wide">
                {{-- Loading spinner --}}
                <svg id="spinnerIcon"
                    class="hidden w-5 h-5 animate-spin text-white"
                    fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10"
                        stroke="currentColor" stroke-width="4"/>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                </svg>
                <span id="btnKirimText">Kirim Laporan Sekarang</span>
            </button>

            <a href="{{ route('masyarakat.dashboard') }}"
                class="block w-full text-center text-sm font-semibold text-gray-500
                       py-3.5 rounded-2xl hover:bg-gray-50 hover:text-gray-700 
                       active:scale-[0.98] transition-all">
                Batalkan
            </a>
        </div>

    </form>
</div>

<script>
    const MAX_CHAR = 500;

    // ── Counter karakter ─────────────────────────────────────────────
    function hitungKarakter(el) {
        const len     = el.value.length;
        const counter = document.getElementById('charCounter');
        counter.textContent = `${len} / ${MAX_CHAR}`;

        if (len >= MAX_CHAR * 0.9) {
            counter.classList.add('text-red-500');
            counter.classList.remove('text-gray-400');
        } else if (len >= 20) {
            counter.classList.add('text-blue-600');
            counter.classList.remove('text-gray-400', 'text-red-500');
        } else {
            counter.classList.remove('text-blue-600', 'text-red-500');
            counter.classList.add('text-gray-400');
        }
    }

    // ── Preview foto (dari galeri atau kamera) ───────────────────────
    function previewFoto(input, dariKamera = false) {
        const file = input.files[0];
        if (!file) return;

        // Sinkronkan: isi input satunya agar form terkirim benar
        if (dariKamera) {
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            document.getElementById('fotoInput').files = dataTransfer.files;
        }

        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('uploadPlaceholder').classList.add('hidden');
            document.getElementById('btnHapusFoto').classList.remove('hidden');

            const img = document.getElementById('previewImg');
            img.src = e.target.result;
            img.classList.remove('hidden');

            // Sesuaikan tinggi area upload
            const area = document.getElementById('uploadArea');
            area.classList.remove('h-32');
            area.classList.add('h-48');
            area.classList.remove('border-gray-300', 'hover:border-blue-400');
            area.classList.add('border-blue-500', 'shadow-md'); // Penyesuaian class saat terisi
        };
        reader.readAsDataURL(file);
    }

    // ── Buka input kamera ────────────────────────────────────────────
    function bukaKamera() {
        document.getElementById('kameraInput').click();
    }

    // ── Hapus foto yang sudah dipilih ────────────────────────────────
    function hapusFoto() {
        document.getElementById('fotoInput').value       = '';
        document.getElementById('kameraInput').value     = '';
        document.getElementById('previewImg').src        = '';
        document.getElementById('previewImg').classList.add('hidden');
        document.getElementById('uploadPlaceholder').classList.remove('hidden');
        document.getElementById('btnHapusFoto').classList.add('hidden');

        const area = document.getElementById('uploadArea');
        area.classList.add('h-32');
        area.classList.remove('h-48', 'border-blue-500', 'shadow-md');
        area.classList.add('border-gray-300', 'hover:border-blue-400');
    }

    // ── Loading state saat form submit ───────────────────────────────
    document.getElementById('formLaporan')
        .addEventListener('submit', function () {
            const btn     = document.getElementById('btnKirim');
            const spinner = document.getElementById('spinnerIcon');
            const text    = document.getElementById('btnKirimText');

            btn.disabled = true;
            btn.classList.add('opacity-90', 'cursor-not-allowed', 'shadow-none');
            spinner.classList.remove('hidden');
            text.textContent = 'Memproses...';
        });

    // ── Inisialisasi: isi counter jika ada old value ─────────────────
    const existingText = document.getElementById('isi_laporan');
    if (existingText && existingText.value.length > 0) {
        hitungKarakter(existingText);
    }
</script>
@endsection