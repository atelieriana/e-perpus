<?php

namespace App\Http\Requests\KodeKelas;

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
            'uuid-kode-kelas' => ['required']
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attribute tidak boleh kosong',
        ];
    }

    public function attributes()
    {
        return [
            'uuid-kode-kelas' => 'UUID kode kelas'
        ];
    }
}
