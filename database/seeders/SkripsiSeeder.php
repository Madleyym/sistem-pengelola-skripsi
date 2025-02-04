<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkripsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skripsi')->insert([
            [
                'mahasiswa_id' => 1,
                'judul_skripsi' => 'Sample Skripsi 1',
                'abstrak' => 'This is a sample abstract for Skripsi 1.',
                'kata_kunci' => 'sample, skripsi, 1',
                'pembimbing1_id' => 1,
                'pembimbing2_id' => 2,
                'status' => 'pengajuan',
                'file_proposal' => 'proposal1.pdf',
                'file_skripsi' => 'skripsi1.pdf',
                'tanggal_pengajuan' => '2023-01-01',
                'tanggal_selesai' => null,
                'keterangan' => 'Initial submission'
            ],
            [
                'mahasiswa_id' => 2,
                'judul_skripsi' => 'Sample Skripsi 2',
                'abstrak' => 'This is a sample abstract for Skripsi 2.',
                'kata_kunci' => 'sample, skripsi, 2',
                'pembimbing1_id' => 2,
                'pembimbing2_id' => 3,
                'status' => 'pengajuan',
                'file_proposal' => 'proposal2.pdf',
                'file_skripsi' => 'skripsi2.pdf',
                'tanggal_pengajuan' => '2023-02-01',
                'tanggal_selesai' => null,
                'keterangan' => 'Initial submission'
            ],
            // Add more sample data as needed
        ]);
    }
}
