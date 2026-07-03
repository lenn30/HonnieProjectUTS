<?php

namespace App\Http\Controllers;

use App\Models\CashInflow;
use App\Http\Requests\CashInflowRequest;

class CashInflowController extends Controller
{
    public function index()
    {
        // Semua user (termasuk User Biasa) boleh melihat data ini
        $cashInflows = CashInflow::orderBy('id', 'desc')->paginate(10);
        $totalIncome = CashInflow::sum('total_pendapatan');
        
        return view('cash_inflow.index', compact('cashInflows', 'totalIncome'));
    }

    public function create()
    {
        // KUNCI: User Biasa dilarang masuk halaman tambah
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak! Hanya Admin yang boleh menambah data transaksi.');
        }

        return view('cash_inflow.create');
    }

    public function store(CashInflowRequest $request)
    {
        // KUNCI: User Biasa dilarang memproses simpan data
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak! Hanya Admin yang boleh menambah data transaksi.');
        }

        $data = $request->validated();
        $data['user_id'] = auth()->id();

        CashInflow::create($data);

        return redirect()->route('cash-inflow.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // KUNCI: User Biasa dilarang masuk halaman edit
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak! Hanya Admin yang boleh mengubah data transaksi.');
        }

        $cash_inflow = CashInflow::findOrFail($id);
        return view('cash_inflow.edit', compact('cash_inflow'));
    }

    public function update(CashInflowRequest $request, $id)
    {
        // KUNCI: User Biasa dilarang memproses update
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak! Hanya Admin yang boleh memperbarui data transaksi.');
        }

        $cash_inflow = CashInflow::findOrFail($id);
        $data = $request->validated();
        $cash_inflow->update($data);

        return redirect()->route('cash-inflow.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // KUNCI: User Biasa dilarang menghapus data
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak! Hanya Admin yang boleh menghapus data transaksi.');
        }

        $cash_inflow = CashInflow::findOrFail($id);
        $cash_inflow->delete();

        return redirect()->route('cash-inflow.index')->with('success', 'Data berhasil dihapus.');
    }
}