<?php

namespace App;
use Illuminate\Support\Arr;

use Illuminate\Database\Eloquent\Model;

class PalletItem extends Model
{
    protected $fillable = [
        'id_farm', 'id_client', 'id_pallet', 'id_load', 'quantity', 'hb', 'qb', 'eb', 'piso', 'farms', 'id_user', 'update_user'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function farms()
    {
        return $this->hasMany('App\Farm', 'id_farm');
    }

    public function clients()
    {
        return $this->hasMany('App\Client', 'id_client');
    }

    public static function groupEqualsItemsCargas($itemsCargaAll, $code)
    {
        foreach($itemsCargaAll as $item)
        {
            // Buscamos los valores duplicados
            $dupliFarm = PalletItem::where('id_load', '=', $code)->where('id_farm', '=', $item->id_farm)->where('id_client', '=', $item->id_client)->count('id_farm');

            if($dupliFarm > 1)
            {
                //$id = ['id' => $item->id];
                $quantity = ['quantity' => PalletItem::where('id_load', '=', $code)->where('id_farm', '=', $item->id_farm)->where('id_client', '=', $item->id_client)->sum('quantity')];
                $hb = ['hb' => PalletItem::where('id_load', '=', $code)->where('id_farm', '=', $item->id_farm)->where('id_client', '=', $item->id_client)->sum('hb')];
                $qb = ['qb' => PalletItem::where('id_load', '=', $code)->where('id_farm', '=', $item->id_farm)->where('id_client', '=', $item->id_client)->sum('qb')];
                $eb = ['eb' => PalletItem::where('id_load', '=', $code)->where('id_farm', '=', $item->id_farm)->where('id_client', '=', $item->id_client)->sum('eb')];
                $piso = ['piso' => $item->piso];
                $farms = ['farms' => $item->farms];
                $id_load = ['id_load' => $item->id_load];
                $id_user = ['id_user' => $item->id_user];
                $update_user = ['update_user' => $item->update_user];
                $id_farm = ['id_farm' => $item->id_farm];
                $id_client = ['id_client' => $item->id_client];
                //$id_pallet = ['id_pallet' => $item->id_pallet];
            }else{
                //$id = ['id' => $item->id];
                $quantity = ['quantity' => $item->quantity];
                $hb = ['hb' => $item->hb];
                $qb = ['qb' => $item->qb];
                $eb = ['eb' => $item->eb];
                $piso = ['piso' => $item->piso];
                $farms = ['farms' => $item->farms];
                $id_load = ['id_load' => $item->id_load];
                $id_user = ['id_user' => $item->id_user];
                $update_user = ['update_user' => $item->update_user];
                $id_farm = ['id_farm' => $item->id_farm];
                $id_client = ['id_client' => $item->id_client];
                //$id_pallet = ['id_pallet' => $item->id_pallet];
            }
            $itemCargaArray[] = Arr::collapse([$quantity, $hb, $qb, $eb, $piso, $farms, $id_load, $id_user, $update_user, $id_farm, $id_client]);
        }
        //dd($itemCargaArray);
        return collect(array_unique($itemCargaArray, SORT_REGULAR));
    }
}
