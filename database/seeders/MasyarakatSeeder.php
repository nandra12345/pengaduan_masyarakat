<?php

namespace Database\Seeders;

use App\Models\Masyarakat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MasyarakatSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nik'      => '3201010101010001',
                'nama'     => 'Ahmad Fauzi',
                'username' => 'ahmad',
                'password' => Hash::make('masyarakat123'),
                'telp'     => '081300000001',
            ],
            [
                'nik'      => '3201010101010002',
                'nama'     => 'Dewi Lestari',
                'username' => 'dewi',
                'password' => Hash::make('masyarakat123'),
                'telp'     => '081300000002',
            ],
            [
                'nik'      => '3201010101010003',
                'nama'     => 'Hendra Wijaya',
                'username' => 'hendra',
                'password' => Hash::make('masyarakat123'),
                'telp'     => '081300000003',
            ],
        ];

        foreach ($data as $item) {
            Masyarakat::updateOrCreate(
                ['nik' => $item['nik']],
                $item
            );
        }

        $this->command->info('✅ Seeder Masyarakat berhasil! (3 akun dummy)');
    }
}