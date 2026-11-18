<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

use App\Models\Buku;

use App\Http\Controllers\BukuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\Admin\PengembalianController;
use App\Http\Controllers\Admin\LaporanPeminjamanController;
use App\Http\Controllers\Petugas\AnggotaController;
use App\Http\Controllers\PeminjamanPribadiController;
use App\Http\Controllers\Api\BukuController as ApiBukuController;

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
| Dashboard Utama
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

    return redirect()->route('buku.index');

})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Dashboard Admin dan Petugas
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard Admin
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->middleware('role:admin')
      ->name('admin.dashboard');

    // Dashboard Petugas
    Route::get('/petugas/dashboard', function () {
        return view('petugas.dashboard');
    })->middleware('role:petugas')
      ->name('petugas.dashboard');

});

/*
|--------------------------------------------------------------------------
| Pengelolaan Pengguna oleh Admin
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'verified',
    'role:admin',
])->prefix('admin')->name('admin.')->group(function () {

    Route::resource('users', UserController::class);

});

/*
|--------------------------------------------------------------------------
| Pengelolaan Buku
|--------------------------------------------------------------------------
*/

Route::get('/buku', [BukuController::class, 'index'])
    ->middleware([
        'auth',
        'verified',
        'permission:lihat daftar buku',
    ])
    ->name('buku.index');

Route::resource('buku', BukuController::class)
    ->except(['index', 'show'])
    ->middleware([
        'auth',
        'verified',
        'can:kelola-buku',
    ]);

/*
|--------------------------------------------------------------------------
| Pencarian Buku
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
| Penghapusan Buku
|--------------------------------------------------------------------------
*/

Route::delete('/buku/{buku}/hapus', [
    ApiBukuController::class,
    'destroy'
])->middleware([
    'auth',
    'can:kelola-buku',
])->name('buku.hapus');

/*
|--------------------------------------------------------------------------
| Detail Peminjaman
|--------------------------------------------------------------------------
*/

Route::get('/peminjaman/{id}', function (string $id) {

    $peminjaman = \App\Models\Peminjaman::with([
        'anggota',
        'buku'
    ])->findOrFail($id);

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
| Peminjaman Pribadi oleh Siswa
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'verified',
])->prefix('peminjaman-saya')->name('peminjaman.saya.')->group(function () {

    Route::get('/ajukan', [
        PeminjamanPribadiController::class,
        'create'
    ])->middleware('permission:mengajukan peminjaman buku')
      ->name('create');

    Route::post('/ajukan', [
        PeminjamanPribadiController::class,
        'store'
    ])->middleware('permission:mengajukan peminjaman buku')
      ->name('store');

    Route::get('/status', [
        PeminjamanPribadiController::class,
        'status'
    ])->middleware('permission:melihat status peminjaman sendiri')
      ->name('status');

    Route::get('/riwayat', [
        PeminjamanPribadiController::class,
        'riwayat'
    ])->middleware('permission:melihat riwayat peminjaman sendiri')
      ->name('riwayat');

});

/*
|--------------------------------------------------------------------------
| Pengelolaan Peminjaman, Pengembalian, dan Laporan
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'verified',
    'role:admin',
])->prefix('admin')->name('admin.')->group(function () {

    Route::resource(
        'peminjaman',
        PeminjamanController::class
    );

    Route::resource(
        'pengembalian',
        PengembalianController::class
    )->only(['index', 'update']);

    Route::get(
        '/laporan-peminjaman',
        [LaporanPeminjamanController::class, 'index']
    )->name('laporan-peminjaman');

    // Admin view for "Status Saya" – shows all peminjaman records without permission check
    Route::get('status-saya', [App\Http\Controllers\PeminjamanPribadiController::class, 'status'])
        ->name('status-saya');

});

/*
|--------------------------------------------------------------------------
| Pengelolaan Anggota oleh Petugas
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'verified',
    'role:petugas',
])->prefix('petugas')->name('petugas.')->group(function () {

    Route::resource(
        'anggota',
        AnggotaController::class
    );

});

/*
|--------------------------------------------------------------------------
| Pengujian CSRF
|--------------------------------------------------------------------------
*/

Route::get('/uji-csrf', function () {
    return view('uji-csrf');
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| Profil Pengguna
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [
        ProfileController::class,
        'edit'
    ])->name('profile.edit');

    Route::patch('/profile', [
        ProfileController::class,
        'update'
    ])->name('profile.update');

    Route::delete('/profile', [
        ProfileController::class,
        'destroy'
    ])->name('profile.destroy');

});

/*
|--------------------------------------------------------------------------
| Pengujian APP_DEBUG
|--------------------------------------------------------------------------
*/

Route::get('/uji-error', function () {
    throw new \RuntimeException('Ini adalah pengujian APP_DEBUG');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
