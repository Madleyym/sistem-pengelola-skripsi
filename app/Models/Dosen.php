<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';

    protected $fillable = [
        'nip',
        'nama_dosen',
        'jenis_kelamin',
        'email',
        'no_telp',
        'alamat',
        'user_id',
        'jurusan_id',
        'status',
        'bidang_keahlian'
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

    // Relasi dengan Skripsi sebagai pembimbing 1
    public function skripsiPembimbing1()
    {
        return $this->hasMany(Skripsi::class, 'pembimbing1_id');
    }

    // Relasi dengan Skripsi sebagai pembimbing 2
    public function skripsiPembimbing2()
    {
        return $this->hasMany(Skripsi::class, 'pembimbing2_id');
    }

    // Relasi dengan Bimbingan
    public function bimbingan()
    {
        return $this->hasMany(Bimbingan::class);
    }

    // Relasi dengan Sidang sebagai penguji
    public function sidangPenguji()
    {
        return $this->hasMany(Sidang::class, 'penguji1_id')
            ->orWhere('penguji2_id', $this->id)
            ->orWhere('penguji3_id', $this->id);
    }
}
