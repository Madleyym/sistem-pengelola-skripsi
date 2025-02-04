<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SeminarSeeder extends Seeder
{
    public function run()
    {
        DB::table('seminar')->insert([
            [
                'skripsi_id' => 1,
                'tanggal_seminar' => Carbon::now()->addDays(7)->toDateString(),
                'waktu_seminar' => '10:00:00',
                'ruangan' => 'Ruang 101',
                'jenis_seminar' => 'proposal',
                'status' => 'terjadwal',
                'catatan' => 'Persiapkan materi dengan baik.',
                'nilai' => null,
                'file_presentasi' => null,
                'file_revisi' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
