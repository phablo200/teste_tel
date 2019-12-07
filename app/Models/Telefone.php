<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //add this line


class Telefone extends Model
{
    use SoftDeletes;     
	protected $table="client_phone";
    protected $fillable = [
        'numero', 'id_cliente'
    ];
}
