<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes; //add this line
class Usuario extends Authenticatable
{
    use SoftDeletes;
	protected $table="user";
    protected $fillable = [
        'nome', 'email', 'senha',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'senha'
    ];
}
