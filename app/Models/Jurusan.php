<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusans';
    protected $primaryKey = 'id_jurusan';

    protected $keyType = 'string';

    protected $fillable = ['nama_jurusan'];

    public function kelas()
    {
        return $this->hasMany(Kelas::class ,'id_jurusan', 'id_jurusan');
    }

    public $timestamps = false;
}
