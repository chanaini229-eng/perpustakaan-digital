<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    // Menampilkan daftar buku
    public function index()
    {
        $bukus = Buku::with('kategori')
            ->latest()
            ->get();

        return view('buku.index', compact('bukus'));
    }

    // Menampilkan formulir tambah buku
    public function create()
    {
        $kategoris = Kategori::all();

        return view('buku.create', compact('kategoris'));
    }

    // Menyimpan buku baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'judul' => 'required|string|max:255|regex:/^[^\d]+$/u',
            'penulis' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1900',
            'stok' => 'required|integer|min:0',
        ]);

        Buku::create($validated);

        return redirect()
            ->route('buku.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    // Menampilkan formulir edit buku
    public function edit(Buku $buku)
    {
        $kategoris = Kategori::all();

        return view('buku.edit', compact('buku', 'kategoris'));
    }

    // Memperbarui data buku
    public function update(Request $request, Buku $buku)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'judul' => 'required|string|max:255|regex:/^[^\d]+$/u',
            'penulis' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1900',
            'stok' => 'required|integer|min:0',
        ]);

        $buku->update($validated);

        return redirect()
            ->route('buku.index')
            ->with('success', 'Buku berhasil diperbarui.');
    }

    // Menghapus buku
    public function destroy(Buku $buku)
    {
        $buku->delete();

        return redirect()
            ->route('buku.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}
