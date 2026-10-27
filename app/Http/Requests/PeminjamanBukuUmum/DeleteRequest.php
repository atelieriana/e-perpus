<?php

namespace App\Http\Requests\PeminjamanBukuUmum;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
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
            'uuid-trans-peminjaman.*' => ['required','uuid'],
        ];
    }

    public function messages()
    {
        return [
            'uuid-trans-peminjaman.*' => ':attribute tidak boleh kosong',
        ];
    }

    public function attributes()
    {
        return [
            'uuid-trans-peminjaman.*' => 'UUID Peminjaman',
        ];
    }
}
