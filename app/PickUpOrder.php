<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PickUpOrder extends Model
{
    protected $fillable = [
        'date',
        'loading_date',
        'loading_hour',
        'carrier_company',
        'driver_name',
        'carrier_num',
        'pick_up_location',
        'pick_up_address',
        'consigned_to',
        'drop_off_address',
        'id_user',
        'update_user'
    ];
}
