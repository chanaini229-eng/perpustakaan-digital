<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanPribadiController extends Controller
{
    /**
     * Memastikan akun login terhubung dengan data anggota.
     * Mengembalikan null jika pengguna adalah admin/petugas tanpa data anggota.
     */
    private function anggotaLogin()
    {
        // Pastikan guard web dipakai
        $user = auth()->user(); // atau auth('web')->user();
        // Pastikan relasi anggota dimuat (eager‑load) supaya tidak null
        $user->loadMissing('anggota');
        $anggota = $user->anggota;

        // Admin atau petugas memang tidak memiliki data anggota; biarkan null
        if (($user->hasRole('admin') || $user->hasRole('petugas')) && !$anggota) {
            return null;
        }

        // Jika user adalah siswa/anggota tapi belum ada data anggota, buat otomatis
        if ($user->hasRole('siswa') && !$anggota) {
            $anggota = Anggota::create([
                'user_id'    => $user->id,
                'nama'       => $user->name,
                'email'      => $user->email,
                'no_telepon' => '0000000000', // placeholder
            ]);
            // Refresh relation pada instance user
            $user->setRelation('anggota', $anggota);
        }

        // Untuk role lain (mis. siswa/anggota) harus ada data anggota
        if (!$anggota) {
            abort(403, 'Akun Anda belum terhubung dengan data anggota. Hubungi administrator.');
        }

        return $anggota;
    }

    /**
     * Menampilkan form pengajuan peminjaman.
     * Hanya buku dengan stok tersedia yang ditampilkan.
     */
    public function create()
    {
        $anggota = $this->anggotaLogin();
        $bukus = Buku::query()
            ->where('stok', '>', 0)
            ->orderBy('judul')
            ->get();

        return view('peminjaman.saya.create', compact('anggota', 'bukus'));
    }

    /**
     * Menyimpan pengajuan peminjaman.
     * Stok tidak berkurang sebelum pengajuan disetujui.
     */
    public function store(Request $request)
    {
        $anggota = $this->anggotaLogin();

        if (!$anggota) {
            return back()->withErrors([
                'buku_id' => 'Akun admin/petugas tidak dapat mengajukan peminjaman. Gunakan akun siswa.',
            ]);
        }

        $validated = $request->validate([
            'buku_id' => ['required', 'integer', 'exists:bukus,id'],
        ], [
            'buku_id.required' => 'Silakan pilih buku yang ingin dipinjam.',
            'buku_id.exists'   => 'Buku yang dipilih tidak ditemukan.',
        ]);

        $berhasil = DB::transaction(function () use ($validated, $anggota) {
            $buku = Buku::query()
                ->whereKey($validated['buku_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if ($buku->stok < 1) {
                return false;
            }

            Peminjaman::create([
                'anggota_id'      => $anggota->id,
                'buku_id'         => $buku->id,
                'tanggal_pinjam'  => now()->toDateString(),
                'tanggal_kembali' => null,
                'status'          => 'menunggu',
            ]);

            return true;
        });

        if (!$berhasil) {
            return back()
                ->withInput()
                ->withErrors([
                    'buku_id' => 'Stok buku habis. Silakan pilih buku lain.',
                ]);
        }

        return redirect()->route('peminjaman.saya.status')
            ->with('success', 'Pengajuan peminjaman berhasil dikirim dan sedang menunggu persetujuan petugas.');
    }

    /**
     * Menampilkan semua status pengajuan milik anggota yang login.
     */
    public function status()
    {
        $anggota = $this->anggotaLogin();

        if ($anggota) {
            $peminjamans = Peminjaman::query()
                ->with('buku')
                ->where('anggota_id', $anggota->id)
                ->latest('id')
                ->paginate(10);
        } else {
            $peminjamans = Peminjaman::query()
                ->with(['buku', 'anggota'])
                ->latest('id')
                ->paginate(10);
        }

        return view('peminjaman.saya.status', compact('peminjamans'));
    }

    /**
     * Menampilkan seluruh riwayat peminjaman anggota yang login.
     */
    public function riwayat()
    {
        $anggota = $this->anggotaLogin();

        $query = Peminjaman::query()
            ->with('buku')
            ->where(function ($q) {
                $q->whereNotNull('tanggal_kembali')
                  ->orWhere('status', 'dikembalikan');
            });

        if ($anggota) {
            $query->where('anggota_id', $anggota->id);
        } else {
            $query->with('anggota');
        }

        $peminjamans = $query->latest('id')->paginate(10);

        return view('peminjaman.saya.riwayat', compact('peminjamans'));
    }
}
