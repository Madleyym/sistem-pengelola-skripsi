<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $fillable = [
        'nim',
        'nama_mahasiswa',
        'jenis_kelamin',
        'email',
        'no_telp',
        'alamat',
        'user_id',
        'jurusan_id',
        'angkatan',
        'status'
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Jurusan
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    // Relasi dengan Skripsi
    public function skripsi()
    {
        return $this->hasOne(Skripsi::class);;
    }
    
}
