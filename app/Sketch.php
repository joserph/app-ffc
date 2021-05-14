<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sketch extends Model
{
    protected $fillable = [
        'id_pallet',
        'id_load',
        'id_user',
        'update_user'
    ];
}
