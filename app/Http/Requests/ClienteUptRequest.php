<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteUptRequest extends FormRequest
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
            "nome"=>"required",
            "data_nascimento"=>"required",
            "local_nascimento"=>"required"
        ];
    }

    public function messages()
    {
        return [
            "nome.required"=>"O nome é necessário",
            "data_nascimento.required"=>"A data de nascimento é necessária",
            "local_nascimento.required"=>"O Local de nascimento é necessário"
        ];
    }
}
