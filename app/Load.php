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
        'update_user'
    ];

    public function invoiceheader()
    {
        return $this->belongsTo('App\InvoiceHeader', 'id_load');
    }
}
