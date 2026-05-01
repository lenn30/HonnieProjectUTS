<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CashInflowController;
use App\Http\Controllers\CashOutflowController;
use App\Models\CashInflow;
use App\Models\CashOutflow;

// Halaman Awal
Route::get('/', function () {
    return view('welcome');
});

// Route Dashboard dengan kalkulasi dinamis
Route::get('/dashboard', function () {
    $totalIncome = CashInflow::sum('total_pendapatan');
    $totalExpense = CashOutflow::sum('total');
    $balance = $totalIncome - $totalExpense;
    
    return view('dashboard', compact('totalIncome', 'totalExpense', 'balance'));
})->middleware(['auth'])->name('dashboard');

// Route Resource yang wajib login
Route::middleware(['auth'])->group(function () {
    
    // Route Profile (Wajib ada untuk menu navigasi Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

   
    Route::resource('users', UserController::class)->except(['show']);
    
    // Route untuk Cash Inflow dan Outflow
    Route::resource('cash-inflow', CashInflowController::class)->except(['show']);
    Route::resource('cash-outflow', CashOutflowController::class)->except(['show']);
});

// Load route authentication (bawaan Laravel Breeze)
require __DIR__.'/auth.php';