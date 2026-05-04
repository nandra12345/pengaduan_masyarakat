<?php

namespace Database\Seeders;

use App\Models\Petugas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // ── ADMIN ────────────────────────────────────────────────────
            [
                'nama_petugas' => 'Administrator',
                'username'     => 'admin',
                'password'     => Hash::make('admin123'),
                'telp'         => '081200000001',
                'level'        => 'admin',
            ],
            // ── PETUGAS ──────────────────────────────────────────────────
            [
                'nama_petugas' => 'Budi Santoso',
                'username'     => 'budi',
                'password'     => Hash::make('petugas123'),
                'telp'         => '081200000002',
                'level'        => 'petugas',
            ],
            [
                'nama_petugas' => 'Siti Rahayu',
                'username'     => 'siti',
                'password'     => Hash::make('petugas123'),
                'telp'         => '081200000003',
                'level'        => 'petugas',
            ],
        ];

        foreach ($data as $item) {
            Petugas::updateOrCreate(
                ['username' => $item['username']],
                $item
            );
        }

        $this->command->info('✅ Seeder Petugas berhasil! (1 admin, 2 petugas)');
    }
}