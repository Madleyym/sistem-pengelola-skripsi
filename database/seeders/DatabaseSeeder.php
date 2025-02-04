<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,    // 1. Buat user lebih dulu
            JurusanSeeder::class,  // 2. Jurusan dibuat lebih dulu
            DosenSeeder::class,    // 3. Dosen membutuhkan user dan jurusan
            MahasiswaSeeder::class, // 4. Mahasiswa membutuhkan user dan jurusan
            SkripsiSeeder::class,  // 5. Skripsi membutuhkan mahasiswa
            SeminarSeeder::class,  // 6. Seminar membutuhkan skripsi
            SidangSeeder::class,   // 7. Sidang membutuhkan skripsi dan dosen
            BimbinganSeeder::class // 8. Bimbingan membutuhkan dosen dan mahasiswa
        ]);
    }
}
