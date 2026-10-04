<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ResetPasswordRequest extends FormRequest
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
            'token' => 'required',
            'id-user' => 'required',
            'password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols()],
            'ulang-password' => ['required', 'same:password'],
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attribute tidak boleh kosong.',
            '*.min' => ':attribute minimal :min karakter.',
            'password' => 'Password minimal 8 karakter, memiliki huruf besar, huruf kecil, dan spesial karakter'
        ];
    }

    public function attributes()
    {
        return [
            'password' => 'Password',
            'ulang-password' => 'Ulang Password',
            'id-user' => 'ID User',
            'token' => 'Token',
        ];
    }
}
