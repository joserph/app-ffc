<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variety extends Model
{
    protected $fillable = [
        'name', 
        'id_user', 
        'update_user'
    ];
}
