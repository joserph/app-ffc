<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Load extends Model
{
    protected $fillable = [
        'shipment',
        'bl',
        'carrier',
        'date',
        'arrival_date',
        'id_user',
        'update_user',
        'code_deep',
        'brand_deep',
        'code_door',
        'brand_door'
    ];

    public function invoiceheader()
    {
        return $this->belongsTo('App\InvoiceHeader', 'id_load');
    }
}
