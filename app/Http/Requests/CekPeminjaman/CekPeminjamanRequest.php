<?php

namespace App\Http\Requests\CekPeminjaman;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CekPeminjamanRequest extends FormRequest
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
            'pencarian' => ['required','integer'],
        ];
    }

    public function messages()
    {
        return [
            'pencarian.required' => 'Harus diisi!',
            'pencarian.integer' => 'Hanya bisa diisi dengan angka',
        ];
    }
}
