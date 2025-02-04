<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SidangSeeder extends Seeder
{
    public function run()
    {
        DB::table('sidang')->insert([
            [
                'skripsi_id' => 1,
                'tanggal_sidang' => Carbon::now()->addDays(14)->toDateString(),
                'waktu_sidang' => '09:00:00',
                'ruangan' => 'Ruang 202',
                'penguji1_id' => 1,
                'penguji2_id' => 2,
                'penguji3_id' => 3,
                'status' => 'terjadwal',
                'nilai_penguji1' => null,
                'nilai_penguji2' => null,
                'nilai_penguji3' => null,
                'nilai_akhir' => null,
                'catatan' => null,
                'file_revisi_final' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
