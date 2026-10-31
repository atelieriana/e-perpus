<?php

namespace App\Http\Requests\SuratBebasPinjam;

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
            'uuid-trans-surat-bebas-pinjam' => ['required','uuid'],
            'tanggal-surat-bebas-peminjaman' => ['required','date'],
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attribute wajib diisi.',
            '*.uuid' => ':attribute tidak valid.',
        ];
    }

    public function attributes()
    {
        return [
            'tanggal-surat-bebas-peminjaman' => 'Tanggal surat bebas peminjaman'
        ];
    }
}
