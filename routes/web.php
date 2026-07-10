<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ============================================
// Route untuk Owner (role: Owner)
// ============================================
Route::middleware(['auth', 'role:Owner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard', function () {
        return view('owner.dashboard');
    })->name('dashboard');
});

// ============================================
// Route untuk Capster (role: Capster)
// ============================================
Route::middleware(['auth', 'role:Capster'])->prefix('capster')->name('capster.')->group(function () {
    Route::get('/transaksi', function () {
        return view('capster.transaksi');
    })->name('transaksi');
});

// ============================================
// Route umum (semua role yang sudah login)
// ============================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Redirect /dashboard lama ke route sesuai role
Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->isOwner()) {
        return redirect()->route('owner.dashboard');
    }
    return redirect()->route('capster.transaksi');
})->middleware('auth')->name('dashboard');

require __DIR__.'/auth.php';
