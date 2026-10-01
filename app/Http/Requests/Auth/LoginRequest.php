<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Laragear\Turnstile\Facades\Turnstile;

class LoginRequest extends FormRequest
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
            'username' => ['required'],
            'password' => ['required'],
            Turnstile::key() => ['turnstile']
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attribute wajib diisi',
            Turnstile::key().'turnstile' => 'Challenge cloudflare gagal. Apakah anda bot?'
        ];
    }

    public function attributes(): array
    {
        return [
            'username' => 'Username',
            'password' => 'Password',
        ];
    }
}
