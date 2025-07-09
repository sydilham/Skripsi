<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\PajakKaryawanController;
use App\Http\Controllers\JenisPajakController;
use App\Http\Controllers\LaporPajakController;
use App\Http\Controllers\TaxConntroller;
use App\Http\Controllers\BuktiPajakController;
use App\Http\Controllers\UserManagementController;
use App\Http\Middleware\RoleMiddleware;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware(['auth','role:operator'])->group(function () {
    // Routes untuk Perusahaan
    Route::get('/perusahaan', [PerusahaanController::class, 'index'])->name('perusahaan.index');
    Route::post('/perusahaan', [PerusahaanController::class, 'store'])->name('perusahaan.store');
    Route::get('/perusahaan/{id}/edit', [PerusahaanController::class, 'edit'])->name('perusahaan.edit');
    Route::put('/perusahaan/{id}', [PerusahaanController::class, 'update'])->name('perusahaan.update');
    Route::delete('/perusahaan/{id}', [PerusahaanController::class, 'destroy'])->name('perusahaan.destroy');

    // Routes untuk Pajak Karyawan
    Route::get('/pajak-barang', [TaxConntroller::class, 'index'])->name('pajak-karyawan.index');
    Route::post('/pajak-barang', [TaxConntroller::class, 'storeItem'])->name('pajak-barang.store');
    Route::get('/pajak-barang/{id}/edit', [TaxConntroller::class, 'editBarang'])->name('pajak-barang.edit');
    Route::put('/pajak-barang/{id}', [TaxConntroller::class, 'updateBarang'])->name('pajak-barang.update');
    Route::delete('/pajak-barang/{id}', [TaxConntroller::class, 'destroyBarang'])->name('pajak-barang.destroy');

    // Routes untuk Jenis Pajak
    Route::get('/jenis-pajak', [JenisPajakController::class, 'index'])->name('jenis-pajak.index');
    Route::post('/jenis-pajak', [JenisPajakController::class, 'store'])->name('jenis-pajak.store');
    Route::get('/jenis-pajak/{id}/edit', [JenisPajakController::class, 'edit'])->name('jenis-pajak.edit');
    Route::put('/jenis-pajak/{id}', [JenisPajakController::class, 'update'])->name('jenis-pajak.update');
    Route::delete('/jenis-pajak/{id}', [JenisPajakController::class, 'destroy'])->name('jenis-pajak.destroy');

    // Routes untuk Lapor Pajak
    Route::get('/lapor-pajak', [TaxConntroller::class, 'indexLaporPajak'])->name('lapor-pajak.index');
    Route::post('/lapor-pajak/store', [TaxConntroller::class, 'generateReport'])->name('lapor-pajak.store');
    Route::post('/lapor-pajak/fetch', [TaxConntroller::class, 'fetch'])->name('fetch');
    Route::get('/lapor-pajak/{id}/print', [LaporPajakController::class, 'print'])->name('lapor-pajak.print');
    Route::get('/laporpajak/{id}/edit', [TaxConntroller::class, 'editLaporan'])->name('lapor-pajak.edit');
    Route::put('/laporpajak/{id}', [TaxConntroller::class, 'updateLaporan'])->name('lapor-pajak.update');
    Route::delete('/lapor-pajak/{id}', [LaporPajakController::class, 'destroy'])->name('lapor-pajak.destroy');
    Route::post('/autocomplete', [TaxConntroller::class, 'autocomplete'])->name('autocomplete');


    //  Bukti Pajak
     Route::get('/bukti-pajak', [BuktiPajakController::class, 'index'])->name('bukti-pajak.index');
    Route::post('/bukti-pajak/store', [BuktiPajakController::class, 'store'])->name('bukti-pajak.store');
    Route::get('/cetak-bukti', [BuktiPajakController::class, 'cetakBuktiPajak'])->name('laporan.cetak');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


        Route::get('/bukti-pajak', [BuktiPajakController::class, 'index'])->name('bukti-pajak.index');
        Route::post('/bukti-pajak/store', [BuktiPajakController::class, 'store'])->name('bukti-pajak.store');
        Route::get('/cetak-bukti', [BuktiPajakController::class, 'cetakBuktiPajak'])->name('laporan.cetak');

        Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserManagementController::class)->except(['show']);
    Route::put('users/{user}/reset-password', [UserManagementController::class, 'resetPassword'])->name('users.reset-password');
});
//         Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
//     Route::get('/users', [UserManagementController::class, 'index'])->name('kelolauser');
//     Route::get('/editusers/{user}', [UserManagementController::class, 'edit'])->name('edituser');
//     Route::post('/addusers', [UserManagementController::class, 'store'])->name('adduser');
//     Route::delete('/admin/users/{user}', [UserManagementController::class, 'destroy'])->name('hapususer');
// Route::put('/users/{id}', [UserManagementController::class, 'update'])->name('usersupdate');
// });
require __DIR__ . '/auth.php';
