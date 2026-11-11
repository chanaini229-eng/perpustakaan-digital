<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PeminjamanController extends Controller
{
    /**
     * Menampilkan seluruh data peminjaman.
     */
    public function index()
    {
        $peminjamans = Peminjaman::with(['anggota', 'buku'])
            ->latest('id')
            ->paginate(10);

        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    /**
     * Menampilkan data pengembalian.
     */
    
public function pengembalian()
{
    $peminjamans = Peminjaman::with(['anggota', 'buku'])
        ->latest('id')
        ->paginate(10);

    $totalTransaksi = Peminjaman::count();

    $belumDikembalikan = Peminjaman::where('status', 'disetujui')
        ->whereNull('tanggal_kembali')
        ->count();

    $sudahDikembalikan = Peminjaman::whereNotNull('tanggal_kembali')
        ->count();

    return view('admin.peminjaman.pengembalian', compact(
        'peminjamans',
        'totalTransaksi',
        'belumDikembalikan',
        'sudahDikembalikan'
    ));
}


    /**
     * Menyetujui pengajuan dan mengurangi stok satu kali.
     */
    public function setujui($id)
    {
        DB::transaction(function () use ($id) {
            $peminjaman = Peminjaman::query()
                ->whereKey($id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($peminjaman->status !== 'menunggu') {
                throw ValidationException::withMessages([
                    'status' => 'Pengajuan ini sudah diproses atau tidak lagi menunggu.',
                ]);
            }

            $buku = Buku::query()
                ->whereKey($peminjaman->buku_id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($buku->stok < 1) {
                throw ValidationException::withMessages([
                    'stok' => 'Stok buku habis. Pengajuan tidak dapat disetujui.',
                ]);
            }

            $buku->decrement('stok');

            $peminjaman->update([
                'status' => 'disetujui',
            ]);
        }, 3);

        return redirect()
            ->route('admin.peminjaman.index')
            ->with('success', 'Pengajuan disetujui dan stok buku berhasil diperbarui.');
    }

    /**
     * Menolak pengajuan yang masih menunggu.
     */
    public function tolak($id)
    {
        DB::transaction(function () use ($id) {
            $peminjaman = Peminjaman::query()
                ->whereKey($id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($peminjaman->status !== 'menunggu') {
                throw ValidationException::withMessages([
                    'status' => 'Hanya pengajuan yang masih menunggu yang dapat ditolak.',
                ]);
            }

            $peminjaman->update([
                'status' => 'ditolak',
            ]);
        }, 3);

        return redirect()
            ->route('admin.peminjaman.index')
            ->with('success', 'Pengajuan peminjaman berhasil ditolak.');
    }

    /**
     * Memproses pengembalian dan menambah stok satu kali.
     */
    public function prosesPengembalian($id)
    {
        $berhasil = DB::transaction(function () use ($id) {
            $peminjaman = Peminjaman::query()
                ->whereKey($id)
                ->lockForUpdate()
                ->firstOrFail();

            // Mencegah stok bertambah dua kali.
            if ($peminjaman->tanggal_kembali !== null) {
                return false;
            }

            if ($peminjaman->status !== 'disetujui') {
                throw ValidationException::withMessages([
                    'status' => 'Hanya peminjaman yang disetujui dan belum dikembalikan yang dapat diproses.',
                ]);
            }

            $buku = Buku::query()
                ->whereKey($peminjaman->buku_id)
                ->lockForUpdate()
                ->firstOrFail();

            $peminjaman->update([
                'tanggal_kembali' => now()->toDateString(),
            ]);

            $buku->increment('stok');

            return true;
        }, 3);

        if (!$berhasil) {
            return redirect()
                ->route('admin.pengembalian.index')
                ->with('error', 'Buku ini sudah pernah dikembalikan.');
        }

        return redirect()
            ->route('admin.pengembalian.index')
            ->with('success', 'Buku berhasil dikembalikan dan stok telah diperbarui.');
    }
}
