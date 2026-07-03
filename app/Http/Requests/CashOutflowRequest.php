<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CashOutflowRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Izinkan semua user yang login mengisi form ini
    }

    public function rules(): array
    {
        return [
            'tanggal' => ['required', 'date'],
            'keterangan' => ['required', 'string', 'max:255'],
            'harga_satuan' => ['required', 'integer', 'min:0'],
            'qty' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'keterangan.required' => 'Keterangan wajib diisi.',
            'keterangan.max' => 'Keterangan maksimal 255 karakter.',
            'harga_satuan.required' => 'Harga satuan wajib diisi.',
            'harga_satuan.integer' => 'Harga satuan harus berupa angka.',
            'harga_satuan.min' => 'Harga satuan tidak boleh minus.',
            'qty.required' => 'Jumlah (QTY) wajib diisi.',
            'qty.integer' => 'Jumlah (QTY) harus berupa angka.',
            'qty.min' => 'Jumlah (QTY) minimal harus 1.',
        ];
    }
}