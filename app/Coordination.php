<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordination extends Model
{
    protected $fillable = [
        'hawb',
        'pieces',
        'hb',
        'qb', 
        'eb', 
        'hb_r',
        'qb_r',
        'eb_r',
        'missing',
        'id_client',
        'id_farm',
        'id_load',
        'variety_id',
        'id_user',
        'update_user',
        'fulls',
        'pieces_r',
        'fulls_r',
        'returns',
        'type'
    ];

    public function farm()
    {
        return $this->belongsTo('App\Farm', 'id_farm');
    }

    public function client()
    {
        return $this->belongsTo('App\Client', 'id_client');
    }

    public function variety()
    {
        return $this->belongsTo('App\Variety', 'variety_id');
    }
}
