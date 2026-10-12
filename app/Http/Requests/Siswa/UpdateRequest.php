<?php

namespace App\Http\Requests\Siswa;

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
            'status-siswa' => ['required'],
            'nisn' => ['required','digits:10'],
            'nomor-induk' => ['required','digits_between:5,6'],
            'nama-lengkap' => ['required','string'],
            'gender' => ['required','string'],
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => ':attribute wajib diisi.',
            '*.max' => ':attribute maksimal :min karakter.',
            '*.digits_between' => ':attribute minimal :min dan maksimal :max digit.',
        ];
    }

    public function attributes()
    {
        return [
            'uuid-siswa' => 'UUID siswa',
            'status-siswa' => 'Status siswa',
            'nisn' => 'NISN',
            'nomor-induk' => 'Nomor induk',
            'nama-siswa' => 'Nama siswa',
            'gender' => 'Gender',
        ];
    }
}
