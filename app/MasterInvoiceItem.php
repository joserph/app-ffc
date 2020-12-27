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
        'variety_id', 
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
        'stems_p_bunches',
        'fa_cl_de'
    ];

    public function farm()
    {
        return $this->belongsTo('App\Farm', 'id_farm');
    }

    public function variety()
    {
        return $this->belongsTo('App\Variety', 'variety_id');
    }

    public function invoiceh()
    {
        return $this->belongsTo('App\InvoiceHeader', 'id_invoiceh');
    }
}
