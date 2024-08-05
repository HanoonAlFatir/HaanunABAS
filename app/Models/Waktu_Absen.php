<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waktu_Absen extends Model
{
    use HasFactory;

    use HasFactory;
    public $primaryKey = 'id_waktu_absen';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $table = 'waktu__absens';
    protected $fillable = [
        'jam_masuk',
        'batas_jam_masuk',
        'jam_pulang',
        'batas_jam_pulang',
    ];

    public function waktu_absen()
    {
        return $this->hasMany(Absensi::class, 'id_waktu_absen');
    }

    public $timestamps = false;
}
