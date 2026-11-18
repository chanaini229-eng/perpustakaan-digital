<?php
// ... (bagian atas file tetap sama)

// Peminjaman Pribadi oleh Siswa
Route::middleware(['auth:web', 'verified'])
    ->prefix('peminjaman-saya')
    ->name('peminjaman.saya.')
    ->group(function () {
        Route::get('/ajukan', [PeminjamanPribadiController::class, 'create'])
            ->middleware('permission:mengajukan peminjaman buku')
            ->name('create');
        Route::post('/ajukan', [PeminjamanPribadiController::class, 'store'])
            ->middleware('permission:mengajukan peminjaman buku')
            ->name('store');
        Route::get('/status', [PeminjamanPribadiController::class, 'status'])
            ->middleware('permission:melihat status peminjaman sendiri')
            ->name('status');
        Route::get('/riwayat', [PeminjamanPribadiController::class, 'riwayat'])
            ->middleware('permission:melihat riwayat peminjaman sendiri')
            ->name('riwayat');
    });

// ... (sisa file tidak berubah)
