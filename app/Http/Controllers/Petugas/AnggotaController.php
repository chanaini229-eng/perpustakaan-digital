<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggotas = Anggota::latest()->paginate(10);

        return view('petugas.anggota.index', compact('anggotas'));
    }

    public function create()
    {
        return view('petugas.anggota.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:anggotas,email',
            'no_telepon' => 'nullable|string|max:20',
        ]);

        Anggota::create($validated);

        return redirect()
            ->route('petugas.anggota.index')
            ->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function edit(Anggota $anggota)
    {
        return view('petugas.anggota.edit', compact('anggota'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:anggotas,email,' . $anggota->id,
            'no_telepon' => 'nullable|string|max:20',
        ]);

        $anggota->update($validated);

        return redirect()
            ->route('petugas.anggota.index')
            ->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(Anggota $anggota)
    {
        if ($anggota->peminjamans()->exists()) {
            return redirect()
                ->route('petugas.anggota.index')
                ->with('error', 'Anggota tidak dapat dihapus karena memiliki riwayat peminjaman.');
        }

        $anggota->delete();

        return redirect()
            ->route('petugas.anggota.index')
            ->with('success', 'Anggota berhasil dihapus.');
    }
}
