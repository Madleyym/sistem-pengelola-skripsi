<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            [
                'username' => 'admin01',
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('adminpassword'),
                'role' => 'admin',
                'foto_profile' => 'admin.jpg',
                'is_active' => true,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'dosen01',
                'name' => 'Dr. Dosen',
                'email' => 'dosen@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('dosenpassword'),
                'role' => 'dosen',
                'foto_profile' => 'dosen.jpg',
                'is_active' => true,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'mahasiswa01',
                'name' => 'Budi Mahasiswa',
                'email' => 'budi@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('mahasiswapassword'),
                'role' => 'mahasiswa',
                'foto_profile' => 'budi.jpg',
                'is_active' => true,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
