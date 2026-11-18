<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Anggota;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // -----------------------------------------------------------------
        // Admin
        // -----------------------------------------------------------------
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('Admin123'),
                'email_verified_at' => now(),
            ]
        );
        $admin->syncRoles(['admin']);

        // -----------------------------------------------------------------
        // Siswa (digunakan untuk login di Vercel)
        // -----------------------------------------------------------------
        $siswa = User::firstOrCreate(
            ['email' => 'nichan@gmail.com'],
            [
                'name' => 'Nichan',
                'password' => Hash::make('nichan123'),
                'email_verified_at' => now(),
            ]
        );
        $siswaRole = Role::firstOrCreate(['name' => 'siswa']);
        $siswa->syncRoles([$siswaRole->name]);

        // Permission yang dibutuhkan siswa
        $siswaPermissions = [
            'mengajukan peminjaman buku',
            'melihat status peminjaman sendiri',
            'melihat riwayat peminjaman sendiri',
            'lihat daftar buku',
        ];
        foreach ($siswaPermissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }
        $siswaRole->syncPermissions($siswaPermissions);

        // Pastikan data anggota ter‑hubung untuk siswa
        Anggota::firstOrCreate(
            ['user_id' => $siswa->id],
            [
                'nama' => $siswa->name,
                'email' => $siswa->email,
                'no_telepon' => '0000000000',
            ]
        );

        // -----------------------------------------------------------------
        // Petugas
        // -----------------------------------------------------------------
        $petugas = User::firstOrCreate(
            ['email' => 'petugas@gmail.com'],
            [
                'name' => 'Petugas',
                'password' => Hash::make('petugas123'),
                'email_verified_at' => now(),
            ]
        );
        $petugasRole = Role::firstOrCreate(['name' => 'petugas']);
        $petugas->syncRoles([$petugasRole->name]);

        // Permission yang petugas perlukan
        $petugasPermissions = [
            'kelola data anggota',
            'kelola peminjaman',
            'kelola pengembalian',
            'lihat daftar buku',
        ];
        foreach ($petugasPermissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }
        $petugasRole->syncPermissions($petugasPermissions);
    }
}
