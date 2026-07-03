<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CashInflow;
use App\Models\CashOutflow;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung total uang masuk
        $totalIncome = CashInflow::sum('total_pendapatan');

        // 2. Hitung total uang keluar
        $totalExpense = CashOutflow::sum('total');

        // 3. Hitung sisa saldo bersih (disamakan jadi $balance sesuai file Blade kamu)
        $balance = $totalIncome - $totalExpense;

        // 4. Kirim data ke halaman dashboard blade
        return view('dashboard', compact('totalIncome', 'totalExpense', 'balance'));
    }
}