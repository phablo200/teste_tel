<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //add this line


class Telefone extends Model
{
    use SoftDeletes;     
	protected $table="cliente_telefone";
    protected $fillable = [
        'numero', 'id_cliente'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    const CREATED_AT = null;
    const UPDATED_AT = null;
}
