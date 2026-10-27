<?php

namespace App\Http\Requests\PeminjamanBukuUmum;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'uuid-ref-kelas' => ['required','uuid'],
            'uuid-ref-kejuruan' => ['required','uuid'],
            'uuid-ref-kode-kelas' => ['required','uuid'],
            'uuid-ref-siswa' => ['required','uuid'],
            'uuid-ref-buku.0' => ['required','uuid'],
            'uuid-ref-buku.*' => ['nullable','uuid'],
            'tanggal-pinjam' => ['required','date', Rule::date()->afterOrEqual(today())],
            'tanggal-terakhir-pinjam' => ['required','date', Rule::date()->afterOrEqual(today())->beforeOrEqual(today()->addWeeks(2))],
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attribute wajib diisi.',
            '*.uuid' => ':attribute tidak valid.',
            '*.after_or_equal' => ':attribute tidak boleh sebelum hari ini.',
            '*.before_or_equal' => ':attribute tidak boleh lebih dari 2 minggu.',
        ];
    }

    public function attributes()
    {
        return [
            'uuid-ref-kelas' => 'Kelas',
            'uuid-ref-kejuruan' => 'Kejuruan',
            'uuid-ref-kode-kelas' => 'Kode kelas',
            'uuid-ref-siswa' => 'Siswa',
            'uuid-ref-buku' => 'Buku',
            'tanggal-pinjam' => 'Tanggal pinjam',
            'tanggal-terakhir-pinjam' => 'Tanggal terakhir pinjam',
        ];
    }
}
