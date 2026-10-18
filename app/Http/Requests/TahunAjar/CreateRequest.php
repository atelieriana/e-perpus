<?php

namespace App\Http\Requests\TahunAjar;

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
            'tahun-ajar' => ['required','regex:/^\d{4}\s*\/\s*\d{4}$/'],
            'tanggal-mulai' => ['required','date'],
            'tanggal-akhir' => ['required','date','after_or_equal:tanggal-mulai'],
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attribute wajib diisi',
            '*.regex' => ':attribute tidak valid',
            '*.date' => ':attribute hanya boleh format tanggal',
            '*.after_or_equal' => ':attribute tanggal akhir hanya boleh lebih atau sama dengan tanggal mulai',
        ];
    }

    public function attributes()
    {
        return [
            'tahun-ajar' => "Tahun ajar",
            'tanggal-mulai' => "Tanggal mulai",
            'tanggal-akhir' => "Tanggal selesai",
        ];
    }
}
