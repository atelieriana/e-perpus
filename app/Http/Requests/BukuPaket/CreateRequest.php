<?php

namespace App\Http\Requests\BukuPaket;

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
            'uuid-kelas' => ['required', 'uuid'],
            'uuid-kejuruan' => ['required', 'uuid'],
            'uuid-buku-pelajaran' => ['required', 'uuid'],
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attribute tidak boleh kosong',
            '*.uuid' => ':attribute tidak valid',
        ];
    }

    public function attributes()
    {
        return [
            'uuid-kelas' => 'Kelas',
            'uuid-kejuruan' => 'Kejuruan',
            'uuid-buku-pelajaran' => 'Buku pelajaran',
        ];
    }
}
