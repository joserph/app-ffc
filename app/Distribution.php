<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
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
        'id_flight',
        'variety_id',
        'id_user',
        'update_user',
        'fulls',
        'pieces_r',
        'fulls_r',
        'returns',
        'observation',
        'id_marketer',
        'duplicate'
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

    public function marketer()
    {
        return $this->belongsTo('App\Marketer', 'id_marketer');
    }

    public function weights()
    {
        return $this->hasMany('App\WeightDistribution', 'id_distribution');
    }
}
