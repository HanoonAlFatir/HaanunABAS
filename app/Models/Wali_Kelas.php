<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wali_Kelas extends Model
{
    use HasFactory;

    protected $table = 'wali__kelas';
    protected $primaryKey = 'nuptk'; // Sesuaikan dengan primary key yang digunakan
    public $incrementing = false; // Karena primary key bukan incrementing integer
    protected $keyType = 'string'; // Tipe data primary key

    protected $fillable = [
        'nuptk',
        'id_user',
        'nama',
        'jenis_kelamin',
        'nip',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function kelas()
    {
        return $this->hasOne(Kelas::class, 'nuptk', 'nuptk');
    }

    public function jurusan()
    {
        return $this->hasOneThrough(Jurusan::class, Kelas::class, 'nuptk', 'id_jurusan', 'nuptk', 'id_jurusan');
    }



    public $timestamps = false;
}
