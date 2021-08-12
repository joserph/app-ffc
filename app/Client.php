<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'state', // Estado
        'city', // Ciudad
        'country',
        'poa',
        'id_user',
        'update_user'
    ];

    public function masterinvoiceitems()
    {
        return $this->hasMany('App\MasterInvoiceItem', 'id_client');
    }
}
