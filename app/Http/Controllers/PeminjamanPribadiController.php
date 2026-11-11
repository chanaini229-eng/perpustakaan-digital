<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanPribadiController extends Controller
{
    /**
     * Memastikan akun login terhubung dengan data anggota.
     */
    private function anggotaLogin()
    {
        $anggota = auth()->user()->anggota;

        if (!$anggota) {
            abort(
                403,
                'Akun Anda belum terhubung dengan data anggota. Hubungi administrator.'
            );
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

        return view(
            'peminjaman.saya.create',
            compact('anggota', 'bukus')
        );
    }

    /**
     * Menyimpan pengajuan peminjaman.
     * Stok tidak berkurang sebelum pengajuan disetujui.
     */
    public function store(Request $request)
    {
        $anggota = $this->anggotaLogin();

        $validated = $request->validate([
            'buku_id' => [
                'required',
                'integer',
                'exists:bukus,id',
            ],
        ], [
            'buku_id.required' => 'Silakan pilih buku yang ingin dipinjam.',
            'buku_id.exists' => 'Buku yang dipilih tidak ditemukan.',
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
                'anggota_id' => $anggota->id,
                'buku_id' => $buku->id,
                'tanggal_pinjam' => now()->toDateString(),
                'tanggal_kembali' => null,
                'status' => 'menunggu',
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

        return redirect()
            ->route('peminjaman.saya.status')
            ->with(
                'success',
                'Pengajuan peminjaman berhasil dikirim dan sedang menunggu persetujuan petugas.'
            );
    }

    /**
     * Menampilkan semua status pengajuan milik anggota yang login.
     *
     * Status yang ditampilkan meliputi menunggu, disetujui,
     * ditolak, dan transaksi yang telah selesai dikembalikan.
     */
    public function status()
    {
        $anggota = $this->anggotaLogin();

        $peminjamans = Peminjaman::query()
            ->with('buku')
            ->where('anggota_id', $anggota->id)
            ->latest('id')
            ->paginate(10);

        return view(
            'peminjaman.saya.status',
            compact('peminjamans')
        );
    }

    /**
     * Menampilkan seluruh riwayat peminjaman anggota yang login.
     */
    
public function riwayat()
{
    $anggota = $this->anggotaLogin();

    $peminjamans = Peminjaman::query()
        ->with('buku')
        ->where('anggota_id', $anggota->id)
        ->where(function ($query) {
            $query->whereNotNull('tanggal_kembali')
                ->orWhere('status', 'dikembalikan');
        })
        ->latest('id')
        ->paginate(10);

    return view('peminjaman.saya.riwayat', compact('peminjamans'));
}

}