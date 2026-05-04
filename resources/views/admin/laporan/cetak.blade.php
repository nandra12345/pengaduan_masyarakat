<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Pengaduan - SiLapor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>

    <style>
        @page {
            size: A4;
            margin: 1.5cm 2cm;
        }
        body {
            font-family: "Times New Roman", Times, serif;
            background-color: white;
            color: black;
            line-height: 1.5;
        }
        /* Style Garis Kop Double */
        .kop-border {
            border-bottom: 3px solid black;
            position: relative;
            margin-bottom: 2px;
        }
        .kop-border::after {
            content: "";
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 100%;
            border-bottom: 1px solid black;
        }
        
        /* Logo Latar Belakang Tabel */
        .tabel-container {
            position: relative;
            width: 100%;
            z-index: 1;
            margin-top: 1rem;
        }

        .tabel-container::before {
            content: "";
            position: absolute;
            top: 10%;
            left: 0;
            width: 100%;
            height: 80%;
            background-image: url("{{ asset('images/logo-instansi.png') }}");
            background-repeat: no-repeat;
            background-position: center;
            background-size: 350px;
            opacity: 0.06;
            z-index: -1;
            pointer-events: none;
        }

        /* Styling Tabel Rapi */
        table { 
            width: 100%;
            border-collapse: collapse; 
            background: transparent;
        }
        
        .table-data th {
            text-transform: uppercase;
            font-size: 10pt;
            font-weight: bold;
            padding: 12px 8px;
            background-color: rgba(240, 240, 240, 0.7) !important;
            -webkit-print-color-adjust: exact;
        }

        .table-data td {
            padding: 10px 8px;
            vertical-align: top;
            line-height: 1.4;
            font-size: 11pt;
        }

        .indent-custom { text-indent: 40px; }
        
        @media print {
            body { margin: 0; }
            * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
        }
    </style>
</head>

<body class="p-2">

@php
    $nomor = "800/" . rand(100,999) . "/SI-LPR/" . date('Y');
    $tgl_sekarang = \Carbon\Carbon::now()->translatedFormat('d F Y');
@endphp

<header class="flex items-center mb-1 px-4">
    <img src="{{ asset('images/logo-instansi.png') }}" class="w-20 h-auto mr-6">
    
    <div class="text-center flex-1">
        <h1 class="text-xl font-bold leading-tight uppercase">Pemerintah Kabupaten / Kota</h1>
        <h2 class="text-2xl font-bold leading-tight uppercase">Dinas Komunikasi dan Informatika</h2>
        <p class="text-xs italic">
            Jl. Kemerdekaan No.123, Telp (021) 1234567, Fax (021) 1234568 <br>
            Website: www.diskominfo.go.id | Email: info@diskominfo.go.id
        </p>
    </div>
</header>

<div class="kop-border mb-6"></div>

<div class="text-center mb-8">
    <h3 class="font-bold underline text-lg uppercase mb-1">REKAPITULASI LAPORAN PENGADUAN MASYARAKAT</h3>
    <p class="text-md font-medium">Nomor: {{ $nomor }}</p>
</div>

<div class="flex justify-between items-start mb-6 text-sm">
    <table>
        <tr>
            <td class="w-24 pb-1">Sifat</td>
            <td class="px-2 pb-1">:</td>
            <td class="pb-1">Biasa</td>
        </tr>
        <tr>
            <td class="pb-1">Lampiran</td>
            <td class="px-2 pb-1">:</td>
            <td class="pb-1">-</td>
        </tr>
        <tr>
            <td class="pb-1">Perihal</td>
            <td class="px-2 pb-1">:</td>
            <td class="font-bold pb-1 text-justify">Laporan Bulanan Sistem Informasi Pengaduan Masyarakat (SiLapor)</td>
        </tr>
    </table>

    <div class="text-center ml-4">
        <canvas id="qr" class="border p-1 bg-white"></canvas>
        <p class="text-[7pt] text-gray-500 mt-1 font-sans uppercase tracking-wider">Validasi Sistem</p>
    </div>
</div>

<p class="mb-4 text-justify indent-custom">
    Berdasarkan data yang terhimpun pada Sistem Informasi Pengaduan Masyarakat (SiLapor), berikut kami sampaikan daftar laporan pengaduan masyarakat yang telah masuk dan diverifikasi untuk periode ini:
</p>

<div class="tabel-container">
    <table class="border-2 border-black table-data">
        <thead>
            <tr class="border-b-2 border-black">
                <th class="border border-black w-[5%] text-center">No</th>
                <th class="border border-black w-[15%] text-center">Tanggal</th>
                <th class="border border-black w-[20%] text-center">Nama Pelapor</th>
                <th class="border border-black w-[45%] text-left px-4">Isi Laporan</th>
                <th class="border border-black w-[15%] text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengaduans as $i => $p)
            <tr class="break-inside-avoid">
                <td class="border border-black text-center font-medium">{{ $i+1 }}</td>
                <td class="border border-black text-center whitespace-nowrap">{{ $p->tgl_pengaduan }}</td>
                <td class="border border-black font-semibold">{{ $p->masyarakat->nama }}</td>
                <td class="border border-black text-justify text-sm leading-relaxed px-4">{{ $p->isi_laporan }}</td>
                <td class="border border-black text-center">
                    <span class="font-bold uppercase italic text-[10pt] tracking-tight">
                        {{ $p->status_label }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="border border-black p-8 text-center italic text-gray-500">
                    Tidak ditemukan data laporan pada sistem untuk periode ini.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<p class="mt-8 text-justify indent-custom">
    Demikian laporan rekapitulasi ini disampaikan. Atas perhatian dan kerja samanya, kami ucapkan terima kasih.
</p>

<div class="flex justify-end mt-16">
    <div class="text-center w-72">
        <p class="mb-1">Jakarta, {{ $tanggalCetak ?? $tgl_sekarang }}</p>
        <p class="font-bold mb-24 uppercase tracking-tighter text-sm">
            Kepala Dinas Komunikasi dan Informatika,
        </p>
        
        <p class="font-bold underline uppercase">Nama Pejabat Anda, S.Kom, M.Si</p>
        <p class="text-sm">NIP. 19850101 201001 1 001</p>
    </div>
</div>

<script>
    const docNumber = "{{ $nomor }}";
    QRCode.toCanvas(document.getElementById('qr'),
    `VERIFIKASI-SILAPOR-${docNumber}`, 
    { 
        width: 75,
        margin: 1 
    }, function (error) {
        if (error) console.error(error)
    });
</script>

</body>
</html>