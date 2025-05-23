<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasukController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
// Halaman daftar barang masuk (ATK)
Route::get('/barang-masuk', [MasukController::class, 'index'])->name('barang-masuk');

// Simpan data baru ATK (Tambah)
Route::post('/barang-masuk', [MasukController::class, 'store'])->name('barang-masuk.store');

// Update data ATK (Edit)
Route::put('/barang-masuk/{id}', [MasukController::class, 'update'])->name('barang-masuk.update');

// Hapus data ATK
Route::delete('/barang-masuk/{id}', [MasukController::class, 'destroy'])->name('barang-masuk.destroy');
// ===================== Mebeler =====================

// Simpan data baru Mebeler
Route::post('/mebeler-masuk', [MasukController::class, 'storeMebeler'])->name('mebeler.store');

// Update data Mebeler
Route::put('/mebeler-masuk/{id}', [MasukController::class, 'updateMebeler'])->name('mebeler.update');

// Hapus data Mebeler
Route::delete('/mebeler-masuk/{id}', [MasukController::class, 'destroyMebeler'])->name('mebeler.destroy');