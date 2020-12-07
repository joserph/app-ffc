<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterInvoiceItem extends Model
{
    protected $fillable = [
        'id_invoiceh', 
        'id_client', 
        'id_farm', 
        'id_load', 
        'description', 
        'hawb', 
        'pieces',
        'hb',
        'qb',
        'eb', 
        'stems', 
        'price',
        'bunches', 
        'fulls',    
        'total',
        'id_user',
        'update_user',
        'stems_p_bunches'
    ];

    public function farm()
    {
        return $this->belongsTo('App\Farm', 'id_farm');
    }
}
