<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PeminjamanController extends Controller
{
    /**
     * Daftar semua pengajuan peminjaman.
     */
    public function index(): View
    {
        $peminjamans = Peminjaman::query()
            ->with(['anggota', 'buku'])
            ->latest('id')
            ->paginate(10);

        $jumlahMenunggu = Peminjaman::where('status', 'menunggu')
            ->count();

        return view(
            'petugas.peminjaman.index',
            compact('peminjamans', 'jumlahMenunggu')
        );
    }

    /**
     * Menyetujui pengajuan dan mengurangi stok buku.
     */
    public function setujui(int $id): RedirectResponse
    {
        $hasil = DB::transaction(function () use ($id) {
            // Kunci transaksi agar pengajuan tidak diproses bersamaan.
            $peminjaman = Peminjaman::query()
                ->whereKey($id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($peminjaman->status !== 'menunggu') {
                return [
                    'berhasil' => false,
                    'pesan' => 'Pengajuan ini sudah diproses sebelumnya.',
                ];
            }

            // Kunci buku agar stok tidak berkurang secara bersamaan.
            $buku = Buku::query()
                ->whereKey($peminjaman->buku_id)
                ->lockForUpdate()
                ->first();

            if (!$buku) {
                return [
                    'berhasil' => false,
                    'pesan' => 'Data buku tidak ditemukan.',
                ];
            }

            if ($buku->stok < 1) {
                return [
                    'berhasil' => false,
                    'pesan' => 'Stok buku habis. Pengajuan tidak dapat disetujui.',
                ];
            }

            $buku->decrement('stok');

            $peminjaman->update([
                'status' => 'disetujui',
            ]);

            return [
                'berhasil' => true,
                'pesan' => 'Pengajuan berhasil disetujui dan stok buku telah diperbarui.',
            ];
        });

        if (!$hasil['berhasil']) {
            return redirect()
                ->route('petugas.peminjaman.index')
                ->with('error', $hasil['pesan']);
        }

        return redirect()
            ->route('petugas.peminjaman.index')
            ->with('success', $hasil['pesan']);
    }

    /**
     * Menolak pengajuan tanpa mengurangi stok buku.
     */
    public function tolak(int $id): RedirectResponse
    {
        $berhasil = DB::transaction(function () use ($id) {
            $peminjaman = Peminjaman::query()
                ->whereKey($id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($peminjaman->status !== 'menunggu') {
                return false;
            }

            $peminjaman->update([
                'status' => 'ditolak',
            ]);

            return true;
        });

        if (!$berhasil) {
            return redirect()
                ->route('petugas.peminjaman.index')
                ->with('error', 'Pengajuan sudah diproses dan tidak dapat ditolak kembali.');
        }

        return redirect()
            ->route('petugas.peminjaman.index')
            ->with('success', 'Pengajuan berhasil ditolak. Stok buku tidak berubah.');
    }
}