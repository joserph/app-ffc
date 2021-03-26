<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PalletItem extends Model
{
    protected $fillable = [
        'id_farm', 'id_client', 'id_pallet', 'id_load', 'quantity', 'hb', 'qb', 'eb', 'piso', 'farms', 'id_user', 'update_user'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function farms()
    {
        return $this->hasMany('App\Farm', 'id_farm');
    }

    public function clients()
    {
        return $this->hasMany('App\Client', 'id_client');
    }
}
