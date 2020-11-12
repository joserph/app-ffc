<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceHeader extends Model
{
    protected $fillable = [
        'id_company', // Mi empresa
        'id_load', // Carga
        'id_logistics_company', // Empresa de logistica
        'bl', 
        'carrier', 
        'invoice',
        'total_bunches',
        'total_fulls',
        'total_pieces',
        'total_stems',
        'total',
        'id_user',
        'update_user'
    ];
}
