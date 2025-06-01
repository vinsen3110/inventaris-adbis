<?php

use App\Http\Controllers\AlatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasukController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MebelerController;

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

    // Mebeler Routes
    Route::prefix('mebeler-masuk')->group(function () {
        Route::post('/', [MebelerController::class, 'storeMebeler'])->name('mebeler.store');
        Route::put('/{id}', [MebelerController::class, 'updateMebeler'])->name('mebeler.update');
        Route::delete('/{id}', [MebelerController::class, 'destroyMebeler'])->name('mebeler.destroy');
    });

    // Mebeler Routes
    Route::prefix('alat-masuk')->group(function () {
        Route::post('/', [AlatController::class, 'storeAlat'])->name('alat.store');
        Route::put('/{id}', [AlatController::class, 'updateAlat'])->name('alat.update');
        Route::delete('/{id}', [AlatController::class, 'destroyAlat'])->name('alat.destroy');
    });
});
