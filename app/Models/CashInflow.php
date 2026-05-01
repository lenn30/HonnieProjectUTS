<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashInflow extends Model
{
    use HasFactory;

    // Tambahkan baris ini untuk memberikan izin penyimpanan data
    protected $guarded = []; 
}