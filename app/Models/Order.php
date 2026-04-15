<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Daftarkan kolom yang boleh diisi
    protected $fillable = [
        'nama_konsumen',
        'nama_barang',
        'jumlah_pesanan',
        'status',
    ];
}