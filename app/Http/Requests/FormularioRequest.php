<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormularioRequest extends FormRequest
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
            'nome' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'assunto' => 'required|string|max:150',
            'imagem' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'mensagem' => 'required|string|max:1000',
        ];
    }

    //Função que retorna as mensagens de erros
    public function messages()
    {
        return [
            'nome.required' => 'O campo :attribute deve ser preenchido',
            'email.required' => 'O campo :attribute deve ser preenchido',
            'email.email' => 'Informe um e-mail válido.',
            'assunto.required' => 'O campo :attribute deve ser preenchido',
            'imagem.required' => 'O campo :attribute deve ser preenchido',
            'imagem.image' => 'O arquivo deve ser uma imagem.',
            'imagem.mimes' => 'A imagem deve estar em formato: jpeg, png, jpg ou gif.',
            'imagem.max' => 'A imagem deve ter no máximo 5MB.',
            'mensagem.required' => 'O campo :attribute deve ser preenchido',
        ];
    }
}
