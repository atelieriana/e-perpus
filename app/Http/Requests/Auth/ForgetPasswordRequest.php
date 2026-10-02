<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Laragear\Turnstile\Facades\Turnstile;

class ForgetPasswordRequest extends FormRequest
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
            'email' => ['required','email'],
            Turnstile::key() => ['turnstile']
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => ':attribute wajib diisi.',
            '*.email' => 'Format :attribute tidak valid.',
            Turnstile::key().'turnstile' => 'Challenge cloudflare gagal.',
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'Email',
        ];
    }
}
