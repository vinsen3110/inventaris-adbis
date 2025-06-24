<?php

use App\Http\Controllers\AlatController;
use App\Http\Controllers\AlatKeluarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasukController;
use App\Http\Controllers\KeluarController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MebelerController;
use App\Http\Controllers\MebelerKeluarController;
use App\Http\Controllers\LaporanInventarisController;

// Public routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login-proses', [AuthController::class, 'authenticating'])->name('login.proses');

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected routes
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // ATK Routes
    Route::prefix('barang-masuk')->group(function () {
        Route::get('/', [MasukController::class, 'index'])->name('barang-masuk');
        Route::post('/', [MasukController::class, 'store'])->name('barang-masuk.store');
        Route::put('/{id}', [MasukController::class, 'update'])->name('barang-masuk.update');
        Route::delete('/{id}', [MasukController::class, 'destroy'])->name('barang-masuk.destroy');
    });
    Route::prefix('barang-keluar')->group(function () {
        Route::get('/', [KeluarController::class, 'index'])->name('barang-keluar');
        Route::post('/', [KeluarController::class, 'store'])->name('barang-keluar.store');
        Route::put('/{id}', [KeluarController::class, 'update'])->name('barang-keluar.update');
        Route::delete('/{id}', [KeluarController::class, 'destroy'])->name('barang-keluar.destroy');
    });

    // Mebeler Routes
    Route::prefix('mebeler-masuk')->group(function () {
        Route::post('/', [MebelerController::class, 'storeMebeler'])->name('mebeler.store');
        Route::put('/{id}', [MebelerController::class, 'updateMebeler'])->name('mebeler.update');
        Route::delete('/{id}', [MebelerController::class, 'destroyMebeler'])->name('mebeler.destroy');
    });

     Route::prefix('mebeler-keluar')->group(function () {
        Route::get('/', [MebelerKeluarController::class, 'index'])->name('mebeler-keluar');
        Route::post('/', [MebelerKeluarController::class, 'storeMebeler'])->name('mebeler-keluar.store');
        Route::put('/{id}', [MebelerKeluarController::class, 'updateMebeler'])->name('mebeler-keluar.update');
        Route::delete('/{id}', [MebelerKeluarController::class, 'destroyMebeler'])->name('mebeler-keluar.destroy');
    });

    // Mebeler Routes
    Route::prefix('alat-masuk')->group(function () {
        Route::post('/', [AlatController::class, 'storeAlat'])->name('alat.store');
        Route::put('/{id}', [AlatController::class, 'updateAlat'])->name('alat.update');
        Route::delete('/{id}', [AlatController::class, 'destroyAlat'])->name('alat.destroy');
    });

    // Mebeler Alat Keluar
    Route::prefix('alat-keluar')->group(function () {
        Route::post('/', [AlatKeluarController::class, 'storeAlat'])->name('alat-keluat.store');
        Route::put('/{id}', [AlatKeluarController::class, 'updateAlat'])->name('alat-keluar.update');
        Route::delete('/{id}', [AlatKeluarController::class, 'destroyAlat'])->name('alat-keluar.destroy');
    });
    Route::get('/laporan-inventaris/pdf', [LaporanInventarisController::class, 'downloadPDF'])->name('barang-masuk.pdf');
});
