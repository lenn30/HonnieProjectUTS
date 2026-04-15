<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController; // WAJIB ADA INI
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Manajemen Pengguna (PPT)
    Route::resource('users', UserController::class);

    // Manajemen Pesanan (Tugas Baru)
    // Baris ini yang mendefinisikan 'orders.index', 'orders.create', dll.
    Route::resource('orders', OrderController::class);
});

require __DIR__.'/auth.php';