<?php

namespace App\Http\Controllers;

use App\Models\CashOutflow;
use App\Http\Requests\CashOutflowRequest; // <-- Import Request Baru

class CashOutflowController extends Controller
{
    public function index()
    {
        // Menggunakan with('user') agar loading data nama user lebih cepat dan ringan
        $cashOutflows = CashOutflow::with('user')->orderBy('id', 'desc')->paginate(10);
        $totalExpense = CashOutflow::sum('total');
        
        return view('cash_outflow.index', compact('cashOutflows', 'totalExpense'));
    }

    public function create()
    {
        return view('cash_outflow.create');
    }

    public function store(CashOutflowRequest $request) // <-- Pakai Request Baru
    {
        $validated = $request->validated();

        // Hitung total pengeluaran
        $validated['total'] = $validated['harga_satuan'] * $validated['qty'];
        
        // Selipkan user_id dari user yang sedang login saat ini
        $validated['user_id'] = auth()->id(); 

        CashOutflow::create($validated);

        return redirect()->route('cash-outflow.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $cash_outflow = CashOutflow::findOrFail($id);
        return view('cash_outflow.edit', compact('cash_outflow'));
    }

    public function update(CashOutflowRequest $request, $id) // <-- Pakai Request Baru
    {
        $validated = $request->validated();

        // Hitung ulang total pengeluaran
        $validated['total'] = $validated['harga_satuan'] * $validated['qty'];
        
        $cash_outflow = CashOutflow::findOrFail($id);
        $cash_outflow->update($validated);

        return redirect()->route('cash-outflow.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        $cash_outflow = CashOutflow::findOrFail($id);
        $cash_outflow->delete();

        return redirect()->route('cash-outflow.index')->with('success', 'Data berhasil dihapus.');
    }
}