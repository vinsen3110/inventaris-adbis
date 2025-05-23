<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasukController;
use App\Http\Controllers\AuthController;

// Public routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
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
        Route::post('/', [MasukController::class, 'storeMebeler'])->name('mebeler.store');
        Route::put('/{id}', [MasukController::class, 'updateMebeler'])->name('mebeler.update');
        Route::delete('/{id}', [MasukController::class, 'destroyMebeler'])->name('mebeler.destroy');
    });
