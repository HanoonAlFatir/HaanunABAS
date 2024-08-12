<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->increments('id_absensi');

            $table->string('nis');
            $table->foreign('nis')->references('nis')->on('siswas');
            $table->enum('status', ['Sakit', 'Hadir', 'Izin','Alfa', 'Terlambat', 'TAP'])->default('Alfa');
            $table->string('photo_in');
            $table->string('photo_out')->nullable();
            $table->string('keterangan')->nullable();
            $table->date('date');
            $table->time('jam_masuk')->nullable();
            $table->time('jam_pulang')->nullable();
            $table->point('titik_koordinat_masuk')->nullable();
            $table->point('titik_koordinat_pulang')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
