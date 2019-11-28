<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "email" => "required",
            "senha" => "required",
            "confirmarSenha"=>"required"
        ];
    }

    public function messages()
    {
        return [
            "email.required" => "Você deve informar o email.",
            "senha.required" => "Você precisa informar a senha",
            "confirmarSenha.required"="Você precisa informar a confirmação de senha"
        ];  
    }
}
