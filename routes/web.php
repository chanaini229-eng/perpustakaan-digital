<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Models\Buku;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\Petugas\AnggotaController;
use App\Http\Controllers\PeminjamanPribadiController;

/*
|--------------------------------------------------------------------------
| Halaman Utama
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard Berdasarkan Role
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    }

    if ($user->hasRole('petugas')) {
        return redirect()->route('petugas.dashboard');
    }

    if ($user->hasRole('siswa')) {
        return redirect()->route('siswa.dashboard');
    }

    abort(403, 'Akun tidak memiliki role yang sesuai.');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Dashboard Admin
|--------------------------------------------------------------------------
*/

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware([
    'auth',
    'verified',
    'permission:akses dashboard admin',
])->name('admin.dashboard');

/*
|--------------------------------------------------------------------------
| Dashboard Siswa
|--------------------------------------------------------------------------
*/

Route::get('/siswa/dashboard', function () {
    return view('siswa.dashboard');
})->middleware([
    'auth',
    'verified',
    'role:siswa',
])->name('siswa.dashboard');

/*
|--------------------------------------------------------------------------
| Pengelolaan Pengguna oleh Admin
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'verified',
    'permission:kelola data pengguna',
])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
});

/*
|--------------------------------------------------------------------------
| Laporan Perpustakaan
|--------------------------------------------------------------------------
*/

Route::get('/admin/laporan-peminjaman', function () {
    return view('admin.laporan-peminjaman');
})->middleware([
    'auth',
    'verified',
    'permission:lihat laporan perpustakaan',
])->name('admin.laporan-peminjaman');

/*
|--------------------------------------------------------------------------
| Peminjaman dan Pengembalian oleh Admin/Petugas
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/peminjaman', [
            PeminjamanController::class,
            'index',
        ])->middleware('permission:kelola peminjaman')
          ->name('peminjaman.index');

        Route::post('/peminjaman/{id}/setujui', [
            PeminjamanController::class,
            'setujui',
        ])->middleware('permission:memproses persetujuan peminjaman')
          ->name('peminjaman.setujui');

        Route::post('/peminjaman/{id}/tolak', [
            PeminjamanController::class,
            'tolak',
        ])->middleware('permission:memproses persetujuan peminjaman')
          ->name('peminjaman.tolak');

        Route::get('/pengembalian', [
            PeminjamanController::class,
            'pengembalian',
        ])->middleware('permission:kelola pengembalian')
          ->name('pengembalian.index');

        Route::post('/pengembalian/{id}/proses', [
            PeminjamanController::class,
            'prosesPengembalian',
        ])->middleware('permission:kelola pengembalian')
          ->name('pengembalian.proses');
    });

/*
|--------------------------------------------------------------------------
| Dashboard Petugas
|--------------------------------------------------------------------------
*/

Route::get('/petugas/dashboard', function () {
    return view('petugas.dashboard');
})->middleware([
    'auth',
    'verified',
    'permission:akses dashboard petugas',
])->name('petugas.dashboard');

/*
|--------------------------------------------------------------------------
| Data Anggota oleh Petugas
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'verified',
    'permission:kelola data anggota',
])->prefix('petugas')->name('petugas.')->group(function () {
    Route::resource('anggota', AnggotaController::class);
});

/*
|--------------------------------------------------------------------------
| Daftar Buku
|--------------------------------------------------------------------------
*/

Route::get('/buku', function () {
    $bukus = Buku::with('kategori')
        ->latest()
        ->get();

    return view('buku.index', compact('bukus'));
})->middleware([
    'auth',
    'verified',
    'permission:lihat daftar buku',
])->name('buku.index');

/*
|--------------------------------------------------------------------------
| Peminjaman Pribadi Siswa
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'verified',
])->prefix('peminjaman-saya')->name('peminjaman.saya.')->group(function () {

    Route::get('/ajukan', [
        PeminjamanPribadiController::class,
        'create',
    ])->middleware('permission:mengajukan peminjaman buku')
      ->name('create');

    Route::post('/ajukan', [
        PeminjamanPribadiController::class,
        'store',
    ])->middleware('permission:mengajukan peminjaman buku')
      ->name('store');

    Route::get('/status', [
        PeminjamanPribadiController::class,
        'status',
    ])->middleware('permission:melihat status peminjaman sendiri')
      ->name('status');

    Route::get('/riwayat', [
        PeminjamanPribadiController::class,
        'riwayat',
    ])->middleware('permission:melihat riwayat peminjaman sendiri')
      ->name('riwayat');
});

/*
|--------------------------------------------------------------------------
| Profil Pengguna
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/profile', [
        ProfileController::class,
        'edit',
    ])->middleware('permission:lihat profil sendiri')
      ->name('profile.edit');

    Route::patch('/profile', [
        ProfileController::class,
        'update',
    ])->middleware('permission:ubah profil sendiri')
      ->name('profile.update');

    Route::delete('/profile', [
        ProfileController::class,
        'destroy',
    ])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Tes Halaman
|--------------------------------------------------------------------------
*/

Route::get('/tes-halaman', function () {
    return response(
        '<h1 style="color:blue">LARAVEL BERHASIL MENAMPILKAN HALAMAN</h1>'
    );
});

/*
|--------------------------------------------------------------------------
| Pengujian SQL Injection (A2) - Sudah Diperbaiki
|--------------------------------------------------------------------------
*/

Route::get('/buku-cari', function () {
    $judul = request()->query('judul');

    $hasil = DB::select(
        "SELECT * FROM bukus WHERE judul = ?",
        [$judul]
    );

    return response()->json($hasil);
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| Pengujian CSRF (A3) - Sudah Diperbaiki
|--------------------------------------------------------------------------
*/

Route::delete('/buku/{buku}/hapus', function (string $buku) {
    return app(\App\Http\Controllers\Api\BukuController::class)
        ->destroy($buku);
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| Halaman Pengujian Penghapusan Buku
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| Pengujian IDOR (A4) - Sudah Diperbaiki dengan Policy
|--------------------------------------------------------------------------
*/

Route::get('/peminjaman/{id}', function (string $id) {
    $peminjaman = \App\Models\Peminjaman::with([
        'anggota',
        'buku'
    ])->findOrFail($id);

    // Memeriksa apakah pengguna berhak melihat peminjaman ini.
    Gate::authorize('view', $peminjaman);

    return response()->json([
        'id' => $peminjaman->id,
        'nama_peminjam' => $peminjaman->anggota->nama,
        'judul_buku' => $peminjaman->buku->judul,
        'tanggal_pinjam' => $peminjaman->tanggal_pinjam,
        'tanggal_kembali' => $peminjaman->tanggal_kembali,
        'status' => $peminjaman->status,
    ]);
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| Autentikasi Laravel Breeze
|--------------------------------------------------------------------------
*/



require __DIR__.'/auth.php';
