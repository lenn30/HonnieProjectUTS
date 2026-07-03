<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashOutflow extends Model
{
    use HasFactory;

    // Mengizinkan semua kolom diisi (mass assignment)
    protected $guarded = []; 

    // Relasi: Setiap data pengeluaran dicatat oleh satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}