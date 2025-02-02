<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bimbingan extends Model
{
    protected $table = 'bimbingan';

    protected $fillable = [
        'skripsi_id',
        'dosen_id',
        'tanggal_bimbingan',
        'waktu_bimbingan',
        'catatan_bimbingan',
        'file_bimbingan',
        'status',
        'keterangan'
    ];

    protected $dates = [
        'tanggal_bimbingan'
    ];

    protected $casts = [
        'waktu_bimbingan' => 'datetime'
    ];

    // Relasi dengan Skripsi
    public function skripsi()
    {
        return $this->belongsTo(Skripsi::class);
    }

    // Relasi dengan Dosen
    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
