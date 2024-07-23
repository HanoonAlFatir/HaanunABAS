<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Wali_Kelas;

class WaliKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Wali_Kelas::create([
            'nuptk' => '1234567890123456',
            'id_user' => 5,
            'nama' => 'Engkus Kusnadi',
            'nip' => '198005052022011001',
            'nik' => '3210123456789012',
        ]);

        Wali_Kelas::create([
            'nuptk' => '2345678901234567',
            'id_user' => 6,
            'nama' => 'Himatul Munawaroh',
            'nip' => '198107062022021002',
            'nik' => '3210987654321098',
        ]);

        Wali_Kelas::create([
            'nuptk' => '3456789012345678',
            'id_user' => 6,
            'nama' => 'Ani Nuraeni',
            'nip' => '198209072022031003',
            'nik' => '3210876543210987',
        ]);
    }
}
