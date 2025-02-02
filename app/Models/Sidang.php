<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sidang extends Model
{
    protected $table = 'sidang';

    protected $fillable = [
        'skripsi_id',
        'tanggal_sidang',
        'waktu_sidang',
        'ruangan',
        'penguji1_id',
        'penguji2_id',
        'penguji3_id',
        'status',
        'nilai_penguji1',
        'nilai_penguji2',
        'nilai_penguji3',
        'nilai_akhir',
        'catatan',
        'file_revisi_final'
    ];

    protected $dates = [
        'tanggal_sidang'
    ];

    protected $casts = [
        'waktu_sidang' => 'datetime',
        'nilai_penguji1' => 'decimal:2',
        'nilai_penguji2' => 'decimal:2',
        'nilai_penguji3' => 'decimal:2',
        'nilai_akhir' => 'decimal:2'
    ];

    // Relasi dengan Skripsi
    public function skripsi()
    {
        return $this->belongsTo(Skripsi::class);
    }

    // Relasi dengan Dosen Penguji 1
    public function penguji1()
    {
        return $this->belongsTo(Dosen::class, 'penguji1_id');
    }

    // Relasi dengan Dosen Penguji 2
    public function penguji2()
    {
        return $this->belongsTo(Dosen::class, 'penguji2_id');
    }

    // Relasi dengan Dosen Penguji 3
    public function penguji3()
    {
        return $this->belongsTo(Dosen::class, 'penguji3_id');
    }
}
