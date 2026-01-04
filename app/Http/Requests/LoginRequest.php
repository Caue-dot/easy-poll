<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'Por favor insira seu nome',
            'name.max' => 'O tamanho máximo do nome é de 255 caracteres',
            'password.required' => 'Por favor insira sua senha'
        ];
    }
}
