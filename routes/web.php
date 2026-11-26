<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlatOlahragaController;
use App\Http\Controllers\AuthController;

// ===== LOGIN & REGISTER (hanya untuk yang belum login) =====
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])
        ->middleware('throttle:10,1')->name('register.store');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1')->name('login.store');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')->name('logout');

// ===== HALAMAN ALAT OLAHRAGA (wajib login) =====
Route::middleware('auth')->group(function () {
    Route::get('/', [AlatOlahragaController::class, 'index'])
        ->name('alat.index');

    Route::get('/alat/create', [AlatOlahragaController::class, 'create'])
        ->name('alat.create');

    Route::post('/alat', [AlatOlahragaController::class, 'store'])
        ->name('alat.store');

    Route::get('/alat/{id}/edit', [AlatOlahragaController::class, 'edit'])
        ->name('alat.edit');

    Route::put('/alat/{id}', [AlatOlahragaController::class, 'update'])
        ->name('alat.update');

    Route::delete('/alat/{id}', [AlatOlahragaController::class, 'destroy'])
        ->name('alat.destroy');
});