<?php

namespace App\Http\Requests\BukuPaket;

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
            'uuid-buku-paket' => ['required', 'uuid'],
            'uuid-kelas' => ['required','uuid'],
            'uuid-buku-pelajaran' => ['required','uuid'],
            'uuid-kejuruan' => ['required','uuid'],
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attribute wajib diisi',
            '*.uuid' => ':attribute tidak valid',
        ];
    }

    public function attributes()
    {
        return [
            'uuid-buku-paket' => 'Buku paket',
            'uuid-buku-pelajaran' => 'Buku pelajaran',
            'uuid-kelas' => 'Kelas',
            'uuid-kejuruan' => 'Kejuruan',
        ];
    }
}
