<?php

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BukuController;


Route::get('/kategori', function () {
    return response()->json(
        Kategori::select('id', 'nama')->get()
    );
});

Route::apiResource('buku', BukuController::class)
    ->names('api.buku')
    ->middlewareFor(['store', 'update', 'destroy'], [
        'auth:sanctum',
        'can:kelola-buku',
    ]);
Route::get('/user', function (Request $request) {
    return $request->user();
    
})->middleware('auth:sanctum');

Route::get('/rekap/buku-per-kategori', [App\Http\Controllers\Api\RekapController::class, 'bukuPerKategori'])->name('api.rekap.buku-per-kategori');
Route::get('/rekap/peminjaman-per-buku', [App\Http\Controllers\Api\RekapController::class, 'peminjamanPerBuku'])->name('api.rekap.peminjaman-per-buku');