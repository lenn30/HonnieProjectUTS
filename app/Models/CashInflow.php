<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashInflow extends Model
{
    use HasFactory;

    protected $guarded = []; 

    // Hubungkan CashInflow ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}