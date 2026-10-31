<?php

namespace App\Http\Requests\SuratBebasPinjam;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'uuid-ref-jenis-bebas-pinjam' => ['required','uuid'],
            'uuid-ref-siswa' => ['required','uuid'],
            'tanggal-surat-bebas-peminjaman' => ['required','date'],
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attribute wajib diisi',
            '*.uuid' => ':attribute tidak valid',
            '*.date' => ':attribute tidak valid',
        ];
    }

    public function attributes()
    {
        return [
            'uuid-ref-jenis-bebas-pinjam' => 'Jenis bebas pinjam',
            'uuid-ref-siswa' => 'Siswa',
            'tanggal-surat-bebas-peminjaman' => 'Tanggal surat bebas pinjam'
        ];
    }
}
