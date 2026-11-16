<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;

class PengembalianController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['anggota', 'buku'])
            ->latest()
            ->get();

        return view('admin.pengembalian.index', compact('peminjamans'));
    }

    public function update(Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'disetujui') {
            return back()->with(
                'error',
                'Peminjaman ini tidak dapat dikembalikan.'
            );
        }

        $peminjaman->update([
            'tanggal_kembali' => now()->toDateString(),
            'status' => 'dikembalikan',
        ]);

        return redirect()
            ->route('admin.pengembalian.index')
            ->with('success', 'Buku berhasil dikembalikan.');
    }
}
