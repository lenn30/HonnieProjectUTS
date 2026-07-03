<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Gembok keamanan: Hanya admin yang boleh lolos validasi ini
        return auth()->check() && auth()->user()->role === 'admin';
    }

    public function rules(): array
    {
        // Mendeteksi apakah ini proses Update (Edit) atau Store (Tambah Baru)
        $userId = $this->route('user') ? $this->route('user')->id : null;

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($userId)],
            'role' => ['required', Rule::in(['admin', 'user'])],
        ];

        // Jika tambah user baru, password wajib diisi
        if ($this->isMethod('post')) {
            $rules['password'] = ['required', 'string', 'min:6', 'confirmed'];
        } else {
            // Jika edit user, password boleh kosong
            $rules['password'] = ['nullable', 'string', 'min:6', 'confirmed'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar di sistem.',
            'role.required' => 'Hak akses (role) wajib dipilih.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal harus 6 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ];
    }
}