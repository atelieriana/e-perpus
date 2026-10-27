<?php

namespace App\Http\Requests\PeminjamanBukuUmum;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'uuid-ref-status-peminjaman.*' => ['required','uuid'],
            'uuid-trans-peminjaman.*' => ['required','uuid'],
            'perpanjangan-pinjam.*' => ['nullable','date'],
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attribute wajib diisi.',
            '*.uuid' => ':attribute tidak valid.',
            '*.date' => ':attribute harus berupa tanggal.',
        ];
    }

    public function attributes()
    {
        return [
            'uuid-ref-status-peminjaman.*' => 'Status peminjaman',
            'uuid-trans-peminjaman.*' => 'UUID transaksi peminjaman',
            'perpanjangan-pinjaman.*' => 'Perpanjangan pinjaman',
        ];
    }
}
