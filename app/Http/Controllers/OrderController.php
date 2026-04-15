<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar semua pesanan (Halaman Utama Manajemen Pesanan)
     */
    public function index()
    {
        // Mengambil data pesanan, diurutkan dari yang terbaru, 10 data per halaman
        $orders = Order::latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    /**
     * Menampilkan formulir untuk menambah pesanan baru
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Menyimpan data pesanan baru ke database
     */
    public function store(Request $request)
    {
        // 1. Validasi input agar data tidak kosong atau salah format
        $request->validate([
            'nama_konsumen' => 'required|string|max:255',
            'nama_barang'   => 'required|string|max:255',
            'jumlah_pesanan' => 'required|numeric|min:1',
        ]);

        // 2. Simpan data ke database
        Order::create([
            'nama_konsumen' => $request->nama_konsumen,
            'nama_barang'   => $request->nama_barang,
            'jumlah_pesanan' => $request->jumlah_pesanan,
            'status'        => 'Belum Terkirim', // Set otomatis status awal
        ]);

        // 3. Kembali ke halaman utama dengan pesan sukses
        return redirect()->route('orders.index')->with('success', 'Pesanan baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan formulir untuk mengedit pesanan yang sudah ada
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.edit', compact('order'));
    }

    /**
     * Memperbarui data pesanan di database
     */
    public function update(Request $request, $id)
    {
        // 1. Validasi input
        $request->validate([
            'nama_konsumen' => 'required|string|max:255',
            'nama_barang'   => 'required|string|max:255',
            'jumlah_pesanan' => 'required|numeric|min:1',
            'status'        => 'required|in:Terkirim,Belum Terkirim',
        ]);

        // 2. Cari data dan update
        $order = Order::findOrFail($id);
        $order->update($request->all());

        // 3. Kembali ke halaman utama
        return redirect()->route('orders.index')->with('success', 'Data pesanan berhasil diperbarui!');
    }

    /**
     * Menghapus pesanan dari database
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Pesanan telah berhasil dihapus!');
    }
}