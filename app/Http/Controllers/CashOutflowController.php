<?php

namespace App\Http\Controllers;

use App\Models\CashOutflow;
use App\Http\Requests\CashOutflowRequest;

class CashOutflowController extends Controller
{
    public function index()
    {
        // Semua user (termasuk User Biasa) boleh melihat ringkasan tabel data ini
        $cashOutflows = CashOutflow::with('user')->orderBy('id', 'desc')->paginate(10);
        $totalExpense = CashOutflow::sum('total');
        
        return view('cash_outflow.index', compact('cashOutflows', 'totalExpense'));
    }

    public function create()
    {
        // KUNCI: User Biasa dilarang masuk halaman tambah data pengeluaran
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak! Hanya Admin yang boleh menambah data pengeluaran.');
        }

        return view('cash_outflow.create');
    }

    public function store(CashOutflowRequest $request)
    {
        // KUNCI: User Biasa dilarang memproses simpan data pengeluaran
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak! Hanya Admin yang boleh menambah data pengeluaran.');
        }

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
        // KUNCI: User Biasa dilarang masuk halaman edit data pengeluaran
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak! Hanya Admin yang boleh mengubah data pengeluaran.');
        }

        $cash_outflow = CashOutflow::findOrFail($id);
        return view('cash_outflow.edit', compact('cash_outflow'));
    }

    public function update(CashOutflowRequest $request, $id)
    {
        // KUNCI: User Biasa dilarang memproses update data pengeluaran
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak! Hanya Admin yang boleh memperbarui data pengeluaran.');
        }

        $validated = $request->validated();

        // Hitung ulang total pengeluaran
        $validated['total'] = $validated['harga_satuan'] * $validated['qty'];
        
        $cash_outflow = CashOutflow::findOrFail($id);
        $cash_outflow->update($validated);

        return redirect()->route('cash-outflow.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // KUNCI: User Biasa dilarang menghapus data pengeluaran
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak! Hanya Admin yang boleh menghapus data pengeluaran.');
        }

        $cash_outflow = CashOutflow::findOrFail($id);
        $cash_outflow->delete();

        return redirect()->route('cash-outflow.index')->with('success', 'Data berhasil dihapus.');
    }
}