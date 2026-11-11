<?php

namespace App\Policies;

use App\Models\Peminjaman;
use App\Models\User;

class PeminjamanPolicy
{
    /**
     * Menentukan siapa yang boleh melihat detail peminjaman.
     */
    public function view(User $user, Peminjaman $peminjaman): bool
    {
        // Admin dan Petugas boleh melihat semua peminjaman.
        if ($user->hasAnyRole(['admin', 'petugas'])) {
            return true;
        }

        // Siswa hanya boleh melihat peminjaman miliknya sendiri.
        if ($user->hasRole('siswa')) {
            return $user->anggota !== null
                && $peminjaman->anggota_id === $user->anggota->id;
        }

        return false;
    }
}
