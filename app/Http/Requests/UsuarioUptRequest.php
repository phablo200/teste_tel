<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class UsuarioUptRequest extends FormRequest
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
    public function rules($id)
    {
        return [
            "email" => "required|unique:usuario",
        ];
    }

    public function messages()
    {
        return [
            "email.required"=>"Você deve informar o email.",
            "email.unique"=>"O email informado já existe no sistema."
        ];  
    }
}
