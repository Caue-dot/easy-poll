<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PollStoreRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'time_limit' => ['required', 'integer', 'min:1'],
            'alternatives' => ['required', 'array', 'min:2', 'max:10'],
            'alternatives.*' => ['required', 'string', 'max:255'],
        ];
    }


    public function messages(): array{
        return [
            'title.required' => 'Por favor insira o título',
            'title.max' => 'O titulo é muito grande(máximo 255 caracteres)',
            'title.string' => 'O titulo deve ser um texto',
            'time_limit.required' => 'Por favor insira o tempo limite',
            'time_limit.integer' => 'O tempo limite deve ser um número',
            'time_limit.min' => 'O tempo limite minimo deve ser 1 hora',
            'alternatives.required' => 'Insira pelo menos duas alternativas',
            'alternatives.min' => 'Insira pelo menos duas alternativas',
            'alternatives.*.max' => 'A alternativa é muito grane(máximo 255 caracteres)',
            'alternatives.*.required' => 'Insira pelo menos duas alternativas',
        ];
    }
}
