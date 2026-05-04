<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
body {
    font-family: DejaVu Sans, serif;
    font-size: 12px;
}

/* WATERMARK */
.watermark {
    position: fixed;
    top: 40%;
    left: 25%;
    opacity: 0.05;
    font-size: 80px;
    transform: rotate(-30deg);
}
table {
    width: 100%;
    border-collapse: collapse;
}
td, th {
    border: 1px solid black;
    padding: 5px;
}
</style>
</head>

<body>

<div class="watermark">SiLAPOR</div>

{{-- KOP --}}
<table>
<tr>
<td width="80">
<img src="{{ public_path('images/logo-instansi.png') }}" width="70">
</td>
<td align="center">
<b>PEMERINTAH DAERAH</b><br>
<b>DINAS KOMUNIKASI DAN INFORMATIKA</b><br>
Jl. Contoh No.123
</td>
</tr>
</table>

<hr>

<h3 align="center"><u>REKAP PENGADUAN MASYARAKAT</u></h3>

<p>Nomor: {{ $nomor }}</p>
<p>Tanggal: {{ $tanggal }}</p>

{{-- QR --}}
<p>
<img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ url('/verifikasi/'.$token) }}">
</p>

<table>
<thead>
<tr>
<th>No</th>
<th>Nama</th>
<th>Laporan</th>
<th>Status</th>
</tr>
</thead>
<tbody>
@foreach($pengaduans as $i => $p)
<tr>
<td>{{ $i+1 }}</td>
<td>{{ $p->masyarakat->nama }}</td>
<td>{{ $p->isi_laporan }}</td>
<td>{{ $p->status_label }}</td>
</tr>
@endforeach
</tbody>
</table>

<br><br>

<table width="100%" border="0">
<tr>
<td></td>
<td align="center">
{{ $tanggal }}<br>
Kepala Dinas<br><br><br><br>
<b>Nama Pejabat</b><br>
NIP. 123456789
</td>
</tr>
</table>

</body>
</html>