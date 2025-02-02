<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skripsi extends Model
{
    protected $table = 'skripsi';

    protected $fillable = [
        'mahasiswa_id',
        'judul_skripsi',
        'abstrak',
        'kata_kunci',
        'pembimbing1_id',
        'pembimbing2_id',
        'status',
        'file_proposal',
        'file_skripsi',
        'tanggal_pengajuan',
        'tanggal_selesai',
        'keterangan'
    ];

    protected $dates = [
        'tanggal_pengajuan',
        'tanggal_selesai'
    ];

    // Relasi dengan Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    // Relasi dengan Dosen Pembimbing 1
    public function pembimbing1()
    {
        return $this->belongsTo(Dosen::class, 'pembimbing1_id');
    }

    // Relasi dengan Dosen Pembimbing 2
    public function pembimbing2()
    {
        return $this->belongsTo(Dosen::class, 'pembimbing2_id');
    }

    // Relasi dengan Bimbingan
    public function bimbingan()
    {
        return $this->hasMany(Bimbingan::class);
    }

    // Relasi dengan Seminar
    public function seminar()
    {
        return $this->hasMany(Seminar::class);
    }

    // Relasi dengan Sidang
    public function sidang()
    {
        return $this->hasOne(Sidang::class);
    }
}
