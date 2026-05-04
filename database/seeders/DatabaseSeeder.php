<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ⚠️ Urutan WAJIB diikuti karena ada foreign key constraint
        $this->call([
            PetugasSeeder::class,      // 1. Petugas & Admin dulu
            MasyarakatSeeder::class,   // 2. Masyarakat
            PengaduanSeeder::class,    // 3. Pengaduan + Tanggapan
        ]);

        $this->command->newLine();
        $this->command->info('🎉 Semua seeder berhasil dijalankan!');
        $this->command->newLine();
        $this->command->table(
            ['Role', 'Username', 'Password'],
            [
                ['Admin',     'admin',  'admin123'],
                ['Petugas',   'budi',   'petugas123'],
                ['Petugas',   'siti',   'petugas123'],
                ['Masyarakat','ahmad',  'masyarakat123'],
                ['Masyarakat','dewi',   'masyarakat123'],
                ['Masyarakat','hendra', 'masyarakat123'],
            ]
        );
    }
}