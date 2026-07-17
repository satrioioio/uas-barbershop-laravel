<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\CapsterController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// ============================================
// Route untuk Owner (role: Owner)
// ============================================
Route::middleware(['auth', 'role:Owner'])->prefix('owner')->name('owner.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [OwnerController::class, 'dashboard'])->name('dashboard');

    // Data Transaksi
    Route::get('/transaksi', [OwnerController::class, 'transaksi'])->name('transaksi');

    // CRUD Layanan
    Route::resource('layanan', LayananController::class)->except(['show']);

    // CRUD Akun
    Route::resource('akun', AkunController::class)->except(['show']);
});

// ============================================
// Route untuk Capster (role: Capster)
// ============================================
Route::middleware(['auth', 'role:Capster'])->prefix('capster')->name('capster.')->group(function () {
    Route::get('/transaksi', [CapsterController::class, 'transaksi'])->name('transaksi');
    Route::post('/transaksi', [CapsterController::class, 'store'])->name('store');
    Route::get('/struk/{id}', [CapsterController::class, 'struk'])->name('struk');
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
