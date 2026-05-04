<?php

namespace Database\Seeders;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\Petugas;
use Illuminate\Database\Seeder;

class PengaduanSeeder extends Seeder
{
    public function run(): void
    {
        $petugas = Petugas::where('level', 'petugas')->first();
        $admin   = Petugas::where('level', 'admin')->first();

        $pengaduans = [
            // ── Pengaduan 1: sudah selesai ───────────────────────────────
            [
                'data' => [
                    'tgl_pengaduan' => now()->subDays(10)->toDateString(),
                    'nik'           => '3201010101010001',
                    'isi_laporan'   => 'Jalan di depan RT 03 RW 02 berlubang cukup besar dan berbahaya bagi pengendara motor, terutama saat malam hari karena tidak ada penerangan.',
                    'foto'          => null,
                    'status'        => 'selesai',
                ],
                'tanggapan' => [
                    'tgl_tanggapan' => now()->subDays(7)->toDateString(),
                    'tanggapan'     => 'Laporan telah diterima dan diteruskan ke Dinas PU. Tim telah melakukan penambalan jalan pada Senin, 3 hari lalu. Terima kasih atas laporan Anda.',
                    'id_petugas'    => $petugas?->id_petugas ?? 2,
                ],
            ],
            // ── Pengaduan 2: sedang diproses ─────────────────────────────
            [
                'data' => [
                    'tgl_pengaduan' => now()->subDays(5)->toDateString(),
                    'nik'           => '3201010101010002',
                    'isi_laporan'   => 'Lampu penerangan jalan umum di Gang Mawar sudah mati selama 2 minggu. Warga merasa tidak aman beraktivitas di malam hari.',
                    'foto'          => null,
                    'status'        => 'proses',
                ],
                'tanggapan' => [
                    'tgl_tanggapan' => now()->subDays(3)->toDateString(),
                    'tanggapan'     => 'Laporan sedang dalam proses penanganan. Tim teknis PLN sudah dijadwalkan untuk melakukan perbaikan pada minggu ini.',
                    'id_petugas'    => $admin?->id_petugas ?? 1,
                ],
            ],
            // ── Pengaduan 3: menunggu ────────────────────────────────────
            [
                'data' => [
                    'tgl_pengaduan' => now()->subDays(2)->toDateString(),
                    'nik'           => '3201010101010003',
                    'isi_laporan'   => 'Terdapat tumpukan sampah liar di pinggir sungai RT 05 yang sudah menimbulkan bau tidak sedap dan dikhawatirkan mencemari air sungai.',
                    'foto'          => null,
                    'status'        => '0',
                ],
                'tanggapan' => null,
            ],
            // ── Pengaduan 4: menunggu ────────────────────────────────────
            [
                'data' => [
                    'tgl_pengaduan' => now()->subDay()->toDateString(),
                    'nik'           => '3201010101010001',
                    'isi_laporan'   => 'Drainase di sepanjang Jalan Kenanga tersumbat dan menyebabkan banjir kecil setiap kali hujan deras. Mohon segera ditindaklanjuti.',
                    'foto'          => null,
                    'status'        => '0',
                ],
                'tanggapan' => null,
            ],
        ];

        foreach ($pengaduans as $item) {
            $pengaduan = Pengaduan::create($item['data']);

            if ($item['tanggapan']) {
                Tanggapan::create([
                    'id_pengaduan'  => $pengaduan->id_pengaduan,
                    'tgl_tanggapan' => $item['tanggapan']['tgl_tanggapan'],
                    'tanggapan'     => $item['tanggapan']['tanggapan'],
                    'id_petugas'    => $item['tanggapan']['id_petugas'],
                ]);
            }
        }

        $this->command->info('✅ Seeder Pengaduan berhasil! (4 laporan dummy)');
    }
}