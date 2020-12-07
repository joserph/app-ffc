<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'address',
        'state', // Estado
        'city', // Ciudad
        'country',
        'id_user',
        'update_user'
    ];

    public function masterinvoiceitems()
    {
        return $this->hasMany('App\MasterInvoiceItem', 'id_farm');
    }
}
