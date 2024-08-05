<?php

namespace Database\Seeders;

use App\Models\Koordinat_Sekolah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KoordinatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Koordinat_Sekolah::create([
            'id_koordinat_sekolah' => '1',
            'titik_koordinat' => '-6.89033536888645, 107.55833009635417',
            'jarak' => 200.00
        ]);
    }
}
