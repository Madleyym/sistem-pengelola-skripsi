<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        DB::table('mahasiswa')->insert([
            [
                'id' => 1,
                'user_id' => 5,
                'nim' => 'NIM001',
                'nama_mahasiswa' => 'John Doe',
                'jenis_kelamin' => 'L',
                'email' => 'john.doe@example.com',
                'no_telp' => '08123456789',
                'alamat' => 'Jl. Example Address No. 1',
                'jurusan_id' => 1,
                'angkatan' => 2020,
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'user_id' => 6,
                'nim' => 'NIM002',
                'nama_mahasiswa' => 'Jane Smith',
                'jenis_kelamin' => 'P',
                'email' => 'jane.smith@example.com',
                'no_telp' => '08123456788',
                'alamat' => 'Jl. Example Address No. 2',
                'jurusan_id' => 1,
                'angkatan' => 2021,
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'user_id' => 7,
                'nim' => 'NIM003',
                'nama_mahasiswa' => 'Michael Johnson',
                'jenis_kelamin' => 'L',
                'email' => 'michael.johnson@example.com',
                'no_telp' => '08123456787',
                'alamat' => 'Jl. Example Address No. 3',
                'jurusan_id' => 2,
                'angkatan' => 2022,
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
