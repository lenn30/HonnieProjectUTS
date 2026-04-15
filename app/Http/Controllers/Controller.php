<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function index()
    {
        // Mengambil data dari database, dibagi 10 data per halaman (sesuai PPT dosenmu)
        $users = \App\Models\User::paginate(10); 
        
        // Mengirimkan data $users ke file tampilan index.blade.php
        return view('users.index', compact('users')); 
    }
} 
