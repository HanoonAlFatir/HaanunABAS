<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Siswa::create([
            'nis' => '0061748352',
            'id_user' => 2,
            'id_kelas' => 1,
            'jenis_kelamin' => 'laki laki',
            'nik' => '5347370412765277',
            'nisn' => '0045678901',
        ]);

        Siswa::create([
            'nis' => '0062894371',
            'id_user' => 3,
            'id_kelas' => 2,
            'jenis_kelamin' => 'laki laki',
            'nik' => '8014821110742201',
            'nisn' => '0045678902',
        ]);

        Siswa::create([
            'nis' => '0069584720',
            'id_user' => 4,
            'id_kelas' => 3,
            'jenis_kelamin' => 'perempuan',
            'nik' => '5347370412765277',
            'nisn' => '0045678903',
        ]);

    }
}
