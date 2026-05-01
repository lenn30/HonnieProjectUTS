<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CashOutflow;

class CashOutflowController extends Controller
{
    public function index()
    {
        $cashOutflows = CashOutflow::orderBy('id', 'desc')->paginate(10);
        $totalExpense = CashOutflow::sum('total');
        return view('cash_outflow.index', compact('cashOutflows', 'totalExpense'));
    }

    public function create()
    {
        return view('cash_outflow.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => ['required', 'date'],
            'keterangan' => ['required', 'string', 'max:255'],
            'harga_satuan' => ['required', 'integer', 'min:0'],
            'qty' => ['required', 'integer', 'min:1'],
        ]);

        $validated['total'] = $validated['harga_satuan'] * $validated['qty'];
        CashOutflow::create($validated);

        return redirect()->route('cash-outflow.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $cash_outflow = CashOutflow::findOrFail($id);
        return view('cash_outflow.edit', compact('cash_outflow'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal' => ['required', 'date'],
            'keterangan' => ['required', 'string', 'max:255'],
            'harga_satuan' => ['required', 'integer', 'min:0'],
            'qty' => ['required', 'integer', 'min:1'],
        ]);

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