<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CashInflowRequest extends FormRequest
{
    /**
     * Tentukan apakah user diizinkan untuk membuat request ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi yang diterapkan pada request.
     */
    public function rules(): array
    {
        return [
            'tanggal' => ['required', 'date'],
            'deskripsi' => ['required', 'string', 'max:255'],
            'total_pendapatan' => ['required', 'integer'],
        ];
    }

    /**
     * Kustomisasi pesan error agar konsisten menggunakan Bahasa Indonesia.
     */
    public function messages(): array
    {
        return [
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.max' => 'Deskripsi maksimal 255 karakter.',
            'total_pendapatan.required' => 'Total pendapatan wajib diisi.',
            'total_pendapatan.integer' => 'Total pendapatan harus berupa angka.',
        ];
    }
}