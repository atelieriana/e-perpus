<?php

namespace App\Http\Requests\BukuPelajaran;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Intervention\Validation\Rules\Isbn;

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
            'judul' => ['required', 'string'],
            'kota-terbit' => ['required', 'string'],
            'penerbit' => ['required', 'string'],
            'penulis' => ['required', 'string'],
            'tahun-terbit' => ['required', 'digits:4'],
            'isbn' => ['required', new Isbn()],
            'halaman' => ['required', 'digits_between:1,4'],
            'jumlah-buku' => ['required', 'integer', 'min:1'],
            'file-cover' => ['file', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => ':attribute wajib diisi.',
            '*.string' => ':attribute hanya dapat diisi oleh huruf.',
            '*.digits' => ':attribute hanya dapat diisi :digits digit.',
            '*.digits_between' => ':attribute hanya dapat diisi minimal :min sampai dengan maksimal :max digit.',
            '*.integer' => ':attribute hanya dapat diisi angka.',
            '*.min' => ':attribute minimal berjumlah :min.',
            '*.file-cover.mimes' => ':attribute hanya dapat diisi :values.',
            '*.file-cover.max' => ':attribute maksimal berukuran :max.',
        ];
    }

    public function attributes()
    {
        return [
            'judul' => 'Judul',
            'kota-terbit' => 'Kota terbit',
            'penerbit' => 'Penerbit',
            'penulis' => 'Penulis',
            'tahun-terbit' => 'Tahun terbit',
            'isbn' => 'ISBN',
            'halaman' => 'Halaman',
            'jumlah_buku' => 'Jumlah buku',
            'file-cover' => 'File cover',
        ];
    }
}
