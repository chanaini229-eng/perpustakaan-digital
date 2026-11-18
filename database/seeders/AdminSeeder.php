<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Anggota;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('Admin123'),
                'email_verified_at' => now(),
            ]
        );
        $admin->syncRoles(['admin']);

        // Siswa user
        $siswa = User::firstOrCreate(
            ['email' => 'nichan@gmail.com'],
            [
                'name' => 'Nichan',
                'password' => Hash::make('nichan123'),
                'email_verified_at' => now(),
            ]
        );
        $siswa->syncRoles(['siswa']);

        // Ensure siswa has a linked anggota record with required fields
        Anggota::firstOrCreate(
            ['user_id' => $siswa->id],
            [
                'nama' => $siswa->name,
                'email' => $siswa->email,
                'no_telepon' => '0000000000', // placeholder, can be updated later
            ]
        );

        // Petugas user
        $petugas = User::firstOrCreate(
            ['email' => 'petugas@gmail.com'],
            [
                'name' => 'Petugas',
                'password' => Hash::make('petugas123'),
                'email_verified_at' => now(),
            ]
        );
        $petugas->syncRoles(['petugas']);
    }
}
