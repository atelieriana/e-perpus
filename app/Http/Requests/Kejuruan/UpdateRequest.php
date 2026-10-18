<?php

namespace App\Http\Requests\Kejuruan;

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
            'uuid' => ['required','uuid'],
            'kejuruan' => ['required','regex:/^[a-zA-Z\s]+$/'],
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attribute wajib diisi.',
            '*.uuid' => ':attribute tidak valid.',
            '*.regex' => ':attribute hanya dapat diisi dengan huruf.',
        ];
    }

    public function attributes()
    {
        return [
            'uuid' => 'UUID',
            'kejuruan' => 'Kejuruan',
        ];
    }
}
