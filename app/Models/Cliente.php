<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //add this line

class Cliente extends Model
{
	use SoftDeletes;     
	protected $table="client";
    protected $fillable = [
        'nome', 
        'cpf', 
        'rg', 
        'id_usuarios_cadastrou', 
        'id_usuarios_atualizou', 
        'data_nascimento', 
        'local_nascimento'
    ];
}
