<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BimbinganSeeder extends Seeder
{
    public function run()
    {
        DB::table('bimbingan')->insert([
            [
                'skripsi_id' => 1,
                'dosen_id' => 1,
                'tanggal_bimbingan' => Carbon::now()->toDateString(),
                'waktu_bimbingan' => Carbon::now()->toTimeString(),
                'catatan_bimbingan' => 'Diskusi terkait metodologi penelitian.',
                'file_bimbingan' => null,
                'status' => 'diajukan',
                'keterangan' => 'Menunggu persetujuan dosen',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
