<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CashInflowController;
use App\Http\Controllers\CashOutflowController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\AdminMiddleware; // <-- 1. Import di bagian atas

// Halaman Awal
Route::get('/', function () {
    return view('welcome');
});

// Route Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// Route Resource yang wajib login
Route::middleware(['auth'])->group(function () {
    
    // 2. Pasang gembok AdminMiddleware di sini
    Route::resource('users', UserController::class)
        ->except(['show'])
        ->middleware(AdminMiddleware::class); 
    
    Route::resource('cash-inflow', CashInflowController::class)->except(['show']);
    Route::resource('cash-outflow', CashOutflowController::class)->except(['show']);
});

// Load route authentication
require __DIR__.'/auth.php';