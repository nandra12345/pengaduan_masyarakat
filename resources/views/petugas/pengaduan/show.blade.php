@extends('layouts.app')
@section('title', 'Detail Pengaduan')
@section('back_url', route('petugas.pengaduan.index'))

@section('content')
<div class="pb-28 bg-gray-50/50 min-h-screen">

    {{-- ───────────────────────────────────────────────
         HEADER & STATUS (Sticky Context)
    ─────────────────────────────────────────────── --}}
    <div class="bg-white px-5 pt-6 pb-6 shadow-[0_4px_20px_rgb(0,0,0,0.02)] rounded-b-3xl border-b border-gray-100 mb-6 sticky top-0 z-20">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h1 class="text-xl font-black text-gray-900 tracking-tight leading-tight">Tiket Pengaduan</h1>
                <div class="flex items-center gap-1.5 mt-2 text-xs font-semibold text-gray-500">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    {{ $pengaduan->tgl_pengaduan->isoFormat('D MMMM YYYY') }}
                </div>
            </div>
            
            {{-- Status Badge Terpusat --}}
            <div class="flex flex-col items-end">
                <span class="text-[10px] px-3 py-1.5 rounded-lg font-black uppercase tracking-wider shadow-sm border border-white/50 {{ $pengaduan->status_color }}">
                    {{ $pengaduan->status_label }}
                </span>
                <span class="text-[10px] text-gray-400 font-bold mt-1 font-mono">ID: #{{ str_pad($pengaduan->id_pengaduan, 5, '0', STR_PAD_LEFT) }}</span>
            </div>
        </div>
    </div>

    <div class="px-5 space-y-5">

        {{-- ───────────────────────────────────────────────
             DATA PELAPOR (Contact Card)
        ─────────────────────────────────────────────── --}}
        <div class="bg-white rounded-2xl p-5 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 relative overflow-hidden">
            <div class="absolute right-0 top-0 w-24 h-24 bg-gray-50 rounded-bl-full -z-10"></div>
            
            <h3 class="text-[11px] font-black text-gray-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Informasi Pelapor
            </h3>
            
            <div class="space-y-3">
                <div class="flex items-center justify-between border-b border-gray-50 pb-3">
                    <span class="text-xs font-semibold text-gray-500">Nama Lengkap</span>
                    <span class="text-sm font-bold text-gray-900">{{ $pengaduan->masyarakat->nama }}</span>
                </div>
                <div class="flex items-center justify-between border-b border-gray-50 pb-3">
                    <span class="text-xs font-semibold text-gray-500">Nomor Induk Kependudukan</span>
                    <span class="text-xs font-bold font-mono text-gray-700 bg-gray-100 px-2 py-1 rounded-md">{{ $pengaduan->masyarakat->nik }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-gray-500">No. Telepon</span>
                    @if($pengaduan->masyarakat->telp)
                        <a href="tel:{{ $pengaduan->masyarakat->telp }}" class="text-sm font-bold text-blue-600 flex items-center gap-1 hover:underline">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            {{ $pengaduan->masyarakat->telp }}
                        </a>
                    @else
                        <span class="text-sm font-bold text-gray-400">-</span>
                    @endif
                </div>
            </div>
        </div>

        {{-- ───────────────────────────────────────────────
             ISI LAPORAN (Content Card)
        ─────────────────────────────────────────────── --}}
        <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 overflow-hidden">
            <div class="p-5">
                <h3 class="text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Uraian Kejadian
                </h3>
                <div class="bg-gray-50/80 rounded-xl p-4 border border-gray-100/50">
                    <p class="text-sm text-gray-800 leading-relaxed font-medium whitespace-pre-wrap">{{ $pengaduan->isi_laporan }}</p>
                </div>
            </div>

            @if($pengaduan->foto)
                <div class="px-5 pb-5">
                    <h3 class="text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Lampiran Foto
                    </h3>
                    <a href="{{ asset('storage/' . $pengaduan->foto) }}" target="_blank" class="block group relative rounded-xl overflow-hidden shadow-sm border border-gray-200">
                        <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto Laporan" class="w-full object-cover max-h-64 transition-transform duration-300 group-hover:scale-105" />
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <span class="text-white text-xs font-bold bg-black/50 px-3 py-1.5 rounded-lg backdrop-blur-sm">Lihat Penuh</span>
                        </div>
                    </a>
                </div>
            @endif
        </div>

        {{-- ───────────────────────────────────────────────
             RIWAYAT TANGGAPAN (Chat Timeline)
        ─────────────────────────────────────────────── --}}
        @if($pengaduan->tanggapans->isNotEmpty())
            <div class="pt-2">
                <div class="flex items-center justify-between mb-4 px-1">
                    <h3 class="font-black text-gray-900 text-sm flex items-center gap-2">
                        💬 Perjalanan Kasus
                    </h3>
                    <span class="text-[10px] font-bold bg-blue-100 text-blue-700 px-2.5 py-1 rounded-full">
                        {{ $pengaduan->tanggapans->count() }} Respon
                    </span>
                </div>
                
                <div class="space-y-3 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-blue-100 before:to-gray-100">
                    @foreach($pengaduan->tanggapans as $t)
                        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                            {{-- Bubble Card --}}
                            <div class="w-[calc(100%-3rem)] md:w-[calc(50%-2.5rem)] bg-white p-4 rounded-2xl shadow-[0_4px_15px_rgb(0,0,0,0.03)] border border-blue-50 relative">
                                <div class="flex justify-between items-start mb-2 border-b border-gray-50 pb-2">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center text-[10px] font-black text-blue-700">
                                            {{ substr($t->petugas->nama_petugas, 0, 1) }}
                                        </div>
                                        <p class="text-xs font-bold text-gray-900">{{ $t->petugas->nama_petugas }}</p>
                                    </div>
                                    <p class="text-[10px] font-bold text-gray-400 mt-0.5">{{ $t->tgl_tanggapan->isoFormat('D MMM YYYY') }}</p>
                                </div>
                                <p class="text-sm text-gray-700 font-medium leading-relaxed">{{ $t->tanggapan }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- ───────────────────────────────────────────────
             FORM TANGGAPAN (Action Area)
        ─────────────────────────────────────────────── --}}
        @if($pengaduan->status !== 'selesai')
            <div class="bg-white rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-blue-100 mt-8 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
                
                <h3 class="font-black text-gray-900 mb-5 flex items-center gap-2">
                    ✍️ Berikan Tanggapan / Tindakan
                </h3>

                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-50/80 border border-red-200 rounded-2xl backdrop-blur-sm">
                        <div class="flex gap-2">
                            <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <div>
                                @foreach($errors->all() as $error)
                                    <p class="text-red-700 text-xs font-bold mb-1 last:mb-0">{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('petugas.pengaduan.tanggapi', $pengaduan->id_pengaduan) }}" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-xs font-bold text-gray-600 uppercase tracking-wide mb-2">Pesan Tanggapan</label>
                        <textarea name="tanggapan" rows="4"
                            placeholder="Ketik detail penyelesaian atau instruksi selanjutnya di sini..."
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-medium text-gray-900 placeholder-gray-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all resize-none shadow-inner">{{ old('tanggapan') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-600 uppercase tracking-wide mb-3">Ubah Status Tiket</label>
                        
                        {{-- Radio Button dengan Efek Peer (Tanpa JS) --}}
                        <div class="grid grid-cols-2 gap-3">
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="status" value="proses" class="peer sr-only" {{ (old('status') === 'proses' || $pengaduan->status === '0' || $pengaduan->status === 'proses') ? 'checked' : '' }} />
                                <div class="p-4 border-2 border-gray-100 rounded-2xl peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:bg-gray-50 transition-all text-center">
                                    <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mx-auto mb-2 peer-checked:bg-blue-500 peer-checked:text-white transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                                    </div>
                                    <span class="text-sm font-bold text-gray-600 peer-checked:text-blue-700">Sedang Diproses</span>
                                </div>
                            </label>

                            <label class="relative cursor-pointer group">
                                <input type="radio" name="status" value="selesai" class="peer sr-only" {{ old('status') === 'selesai' ? 'checked' : '' }} />
                                <div class="p-4 border-2 border-gray-100 rounded-2xl peer-checked:border-green-500 peer-checked:bg-green-50 hover:bg-gray-50 transition-all text-center">
                                    <div class="w-8 h-8 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center mx-auto mb-2 peer-checked:bg-green-500 peer-checked:text-white transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                                    </div>
                                    <span class="text-sm font-bold text-gray-600 peer-checked:text-green-700">Tandai Selesai</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-2xl transition-all shadow-lg shadow-blue-200 active:scale-[0.98] text-sm uppercase tracking-wider">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                        Kirim & Simpan Data
                    </button>
                </form>
            </div>
        @else
            {{-- Banner Selesai (Success State) --}}
            <div class="mt-8 bg-gradient-to-br from-green-500 to-emerald-600 rounded-3xl p-6 shadow-lg shadow-green-200 text-center relative overflow-hidden">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-white/10 rounded-full blur-xl pointer-events-none"></div>
                <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-3 border border-white/30">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-white text-lg font-black tracking-wide mb-1">Kasus Telah Ditutup</h3>
                <p class="text-green-50 text-xs font-medium">Pengaduan ini telah selesai ditangani dan tidak memerlukan tindakan lebih lanjut.</p>
            </div>
        @endif

    </div>
</div>
@endsection