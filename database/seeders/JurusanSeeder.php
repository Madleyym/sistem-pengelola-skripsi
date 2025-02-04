<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JurusanSeeder extends Seeder
{
    public function run()
    {
        DB::table('jurusan')->insert([
            [
                'kode_jurusan' => 'TI',
                'nama_jurusan' => 'Teknik Informatika',
                'kepala_jurusan' => 'Dr. Budi Santoso',
                'deskripsi' => 'Jurusan Teknik Informatika berfokus pada pengembangan software.',
                'akreditasi' => 'A',
                'status_aktif' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_jurusan' => 'SI',
                'nama_jurusan' => 'Sistem Informasi',
                'kepala_jurusan' => 'Dr. Siti Aisyah',
                'deskripsi' => 'Jurusan Sistem Informasi berfokus pada manajemen informasi.',
                'akreditasi' => 'A',
                'status_aktif' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
