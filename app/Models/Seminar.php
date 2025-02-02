<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
    protected $table = 'seminar';

    protected $fillable = [
        'skripsi_id',
        'tanggal_seminar',
        'waktu_seminar',
        'ruangan',
        'jenis_seminar',
        'status',
        'catatan',
        'nilai',
        'file_presentasi',
        'file_revisi'
    ];

    protected $dates = [
        'tanggal_seminar'
    ];

    protected $casts = [
        'waktu_seminar' => 'datetime',
        'nilai' => 'decimal:2'
    ];

    // Relasi dengan Skripsi
    public function skripsi()
    {
        return $this->belongsTo(Skripsi::class);
    }
}
