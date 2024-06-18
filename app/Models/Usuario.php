<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens;

    protected $fillable = [
        'nome', 'email', 'senha',
    ];

    protected $hidden = [
        'senha',
    ];
}

