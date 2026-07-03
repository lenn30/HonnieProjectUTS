<?php

namespace App\Http\Controllers;

use App\Models\CashInflow;
use App\Http\Requests\CashInflowRequest; // <-- Import form request baru

class CashInflowController extends Controller
{
    public function index()
    {
        // Menambahkan filter supaya user hanya melihat datanya sendiri
        $cashInflows = CashInflow::where('user_id', auth()->id())->orderBy('id', 'desc')->paginate(10);
        $totalIncome = CashInflow::where('user_id', auth()->id())->sum('total_pendapatan');
        
        return view('cash_inflow.index', compact('cashInflows', 'totalIncome'));
    }

    public function create()
    {
        return view('cash_inflow.create');
    }

    public function store(CashInflowRequest $request) // <-- Gunakan CashInflowRequest
    {
        $data = $request->validated(); // Ambil data yang sudah lolos validasi
        $data['user_id'] = auth()->id(); // Masukkan ID user yang sedang login

        CashInflow::create($data);

        return redirect()->route('cash-inflow.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $cash_inflow = CashInflow::findOrFail($id);
        return view('cash_inflow.edit', compact('cash_inflow'));
    }

    public function update(CashInflowRequest $request, $id) // <-- Gunakan CashInflowRequest
    {
        $data = $request->validated();
        
        $cash_inflow = CashInflow::findOrFail($id);
        $cash_inflow->update($data);

        // Ubah kata "diupdate" jadi "diperbarui" agar konsisten bahasa Indonesia
        return redirect()->route('cash-inflow.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $cash_inflow = CashInflow::findOrFail($id);
        $cash_inflow->delete();

        return redirect()->route('cash-inflow.index')->with('success', 'Data berhasil dihapus.');
    }
}