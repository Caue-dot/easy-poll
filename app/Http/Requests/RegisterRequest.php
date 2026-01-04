<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'Por favor insira seu nome',
            'name.max' => 'O tamanho máximo do nome é de 255 caracteres',
            'email.required' => 'Por favor insira um email',
            'email.email' => 'Por favor insira um email válido',
            'email.unique' => 'Esse email já está cadastrado',
            'password.required' => 'Por favor insira sua senha',
            'password.min' => 'A senha tem que ter no mínimo 8 caracteres',
        ];
    }
}
