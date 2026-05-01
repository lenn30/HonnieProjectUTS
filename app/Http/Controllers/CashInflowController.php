<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CashInflow;

class CashInflowController extends Controller
{
    public function index()
    {
        $cashInflows = CashInflow::orderBy('id', 'desc')->paginate(10);
        $totalIncome = CashInflow::sum('total_pendapatan');
        return view('cash_inflow.index', compact('cashInflows', 'totalIncome'));
    }

    public function create()
    {
        return view('cash_inflow.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => ['required', 'date'],
            'deskripsi' => ['required', 'string', 'max:255'],
            'total_pendapatan' => ['required', 'integer'],
        ]);

        CashInflow::create($validated);

        return redirect()->route('cash-inflow.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Mencari data berdasarkan ID untuk dikirim ke form edit
        $cash_inflow = CashInflow::findOrFail($id);
        return view('cash_inflow.edit', compact('cash_inflow'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal' => ['required', 'date'],
            'deskripsi' => ['required', 'string', 'max:255'],
            'total_pendapatan' => ['required', 'integer'],
        ]);

        // Mencari data lama lalu mengupdatenya dengan data baru
        $cash_inflow = CashInflow::findOrFail($id);
        $cash_inflow->update($validated);

        return redirect()->route('cash-inflow.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        // Mencari data lalu menghapusnya
        $cash_inflow = CashInflow::findOrFail($id);
        $cash_inflow->delete();

        return redirect()->route('cash-inflow.index')->with('success', 'Data berhasil dihapus.');
    }
}