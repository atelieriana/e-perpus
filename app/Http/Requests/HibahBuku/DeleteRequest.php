<?php

namespace App\Http\Requests\HibahBuku;

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
            'uuid-trans-hibah' => ['required','uuid'],
            'uuid-ref-buku' => ['required','uuid'],
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
            'uuid-trans-hibah' => 'UUID Hibah',
            'uuid-ref-buku' => 'UUID Ref Buku',
        ];
    }
}
