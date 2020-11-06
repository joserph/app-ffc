<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'address',
        'state', // Estado
        'city', // Ciudad
        'country',
        'poa',
        'id_user',
        'update_user'
    ];
}
