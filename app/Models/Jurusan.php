<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';

    protected $fillable = [
        'kode_jurusan',
        'nama_jurusan',
        'kepala_jurusan',
        'deskripsi',
        'akreditasi',
        'status_aktif'
    ];

    protected $casts = [
        'status_aktif' => 'boolean'
    ];

    // Relasi dengan Dosen
    public function dosen()
    {
        return $this->hasMany(Dosen::class);
    }

    // Relasi dengan Mahasiswa
    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }
}
