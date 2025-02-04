<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DosenSeeder extends Seeder
{
    public function run()
    {
        $users = [
            ['name' => 'Dr. Budi Santoso', 'username' => 'budi', 'email' => 'budi@example.com', 'password' => Hash::make('password'), 'role' => 'dosen'],
            ['name' => 'Siti Aisyah', 'username' => 'siti', 'email' => 'siti@example.com', 'password' => Hash::make('password'), 'role' => 'dosen'],
            ['name' => 'Ahmad Fadli', 'username' => 'ahmad', 'email' => 'ahmad@example.com', 'password' => Hash::make('password'), 'role' => 'dosen'],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['username' => $userData['username']],
                $userData
            );

            Dosen::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'nip' => 'NIP' . $user->id,
                    'nama_dosen' => $userData['name'],
                    'jenis_kelamin' => 'L', // or 'P' based on your data
                    'email' => $userData['email'],
                    'no_telp' => '08123456789', // example phone number
                    'alamat' => 'Jl. Contoh Alamat No. ' . $user->id, // example address
                    'jurusan_id' => 1, // example jurusan_id
                    'status' => 'aktif',
                    'bidang_keahlian' => 'Bidang Keahlian ' . $user->id // example bidang keahlian
                ]
            );
        }
    }
}
