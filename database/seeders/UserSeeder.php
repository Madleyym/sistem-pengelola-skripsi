<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['id' => 1, 'name' => 'Admin', 'username' => 'admin', 'email' => 'admin@example.com', 'password' => Hash::make('password'), 'role' => 'admin'],
            ['id' => 2, 'name' => 'Dr. Budi Santoso', 'username' => 'budi', 'email' => 'budi@example.com', 'password' => Hash::make('password'), 'role' => 'dosen'],
            ['id' => 3, 'name' => 'Siti Aisyah', 'username' => 'siti', 'email' => 'siti@example.com', 'password' => Hash::make('password'), 'role' => 'dosen'],
            ['id' => 4, 'name' => 'Ahmad Fadli', 'username' => 'ahmad', 'email' => 'ahmad@example.com', 'password' => Hash::make('password'), 'role' => 'dosen'],
            ['id' => 5, 'name' => 'Rizky Ramadhan', 'username' => 'rizky', 'email' => 'rizky@example.com', 'password' => Hash::make('password'), 'role' => 'mahasiswa'],
            ['id' => 6, 'name' => 'Fitri Lestari', 'username' => 'fitri', 'email' => 'fitri@example.com', 'password' => Hash::make('password'), 'role' => 'mahasiswa'],
            ['id' => 7, 'name' => 'Doni Saputra', 'username' => 'doni', 'email' => 'doni@example.com', 'password' => Hash::make('password'), 'role' => 'mahasiswa'],
        ]);
    }
}
