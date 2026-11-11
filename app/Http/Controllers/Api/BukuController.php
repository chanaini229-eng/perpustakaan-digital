<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BukuRequest;
use App\Http\Resources\BukuResource;
use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::with('kategori')
            ->withCount('peminjamans');

        if ($request->filled('cari')) {
            $cari = $request->cari;

            $query->where(function ($q) use ($cari) {
                $q->where('judul', 'like', "%{$cari}%")
                    ->orWhere('penulis', 'like', "%{$cari}%");
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun_terbit', $request->tahun);
        }

        $bukus = $query->paginate(10)->withQueryString();

        return BukuResource::collection($bukus);
    }

    public function store(BukuRequest $request)
    {
        $buku = Buku::create($request->validated());

        return (new BukuResource(
            $buku->load('kategori')
        ))->response()->setStatusCode(201);
    }

    public function show(string $id)
    {
        $buku = Buku::with('kategori', 'peminjamans')
            ->findOrFail($id);

        return new BukuResource($buku);
    }

    public function update(BukuRequest $request, string $id)
    {
        $buku = Buku::findOrFail($id);
        $buku->update($request->validated());

        return new BukuResource($buku->load('kategori'));
    }

    public function destroy(string $id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        return response()->json([
            'message' => 'Buku berhasil dihapus',
        ], 200);
    }
}
