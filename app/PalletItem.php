<?php

namespace App;
use Illuminate\Support\Arr;
use App\Pallet;

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

    public function farm()
    {
        return $this->belongsTo('App\Farm', 'id_farm');
    }

    /*public function clients()
    {
        return $this->hasMany('App\Client', 'id_client');
    }*/

    public function client()
    {
        return $this->belongsTo('App\Client', 'id_client');
    }

    public static function groupEqualsItemsCargas($itemsCargaAll, $code)
    {
        $itemCargaArray = [];
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
                $farms = ['farms' => $item->farms];
                $id_load = ['id_load' => $item->id_load];
                $id_user = ['id_user' => $item->id_user];
                $update_user = ['update_user' => $item->update_user];
                $id_farm = ['id_farm' => $item->id_farm];
                $id_client = ['id_client' => $item->id_client];
                //$id_pallet = ['id_pallet' => $item->id_pallet];
            }
            $itemCargaArray[] = Arr::collapse([$quantity, $hb, $qb, $eb, $farms, $id_load, $id_user, $update_user, $id_farm, $id_client]);
        }
        //dd($itemCargaArray);
        return collect(array_unique($itemCargaArray, SORT_REGULAR));
    }

    public static function updateTotalPallet($id_pallet)
    {
        $total_pallet = PalletItem::where('id_pallet', '=', $id_pallet)->sum('quantity');
        //dd($total_pallet);
        $pallet_update = Pallet::find($id_pallet);
        $pallet_update->quantity = $total_pallet;
        $pallet_update->save();
        
    }

    public static function createSketchPercent($id_load)
    {
        $pallets = Pallet::where('id_load', $id_load)->select('id')->get();
        
        foreach($pallets as $pa)
        {
            $searchClient = PalletItem::where('id_pallet', $pa->id)->select('id_client', 'id_pallet', 'quantity')->get()->toArray();

            $newGroupClient = PalletItem::groupPlusClient($searchClient);

            
            foreach($newGroupClient as $cli)
            {
                PalletItem::addNewSketch($cli, $id_load);
            }
            
            //$newGroupClient = PalletItem::groupPlusClient($searchClient);
            
            // Buscamos en la tabla SketchPercent todos los existentes
            $percentE = SketchPercent::where('id_pallet', $pa->id)->get();
            //dd($percentE);
            $newResult = PalletItem::addPercentClient($newGroupClient, $percentE, $pa->id);
            //dd($newResult);
        }
        
    }

    public static function addNewSketch($searchClient, $id_load)
    {
        
        $percentPallet = SketchPercent::create([
            'id_user'       => \Auth::user()->id,
            'update_user'   => \Auth::user()->id,
            'id_load'       => $id_load,
            'id_pallet'     => $searchClient['id_pallet'],
            'percent'       => 100,
            'id_client'     => $searchClient['id_client']
        ]);
        
    }

    public static function groupPlusClient($searchClient)
    {
        $groupClient = array();
        foreach($searchClient as $cli)
        {
            $repeat = false;
            for($i = 0; $i < count($groupClient); $i++)
            {
                if($groupClient[$i]['id_client'] == $cli['id_client'])
                {
                    $groupClient[$i]['quantity']+= $cli['quantity'];
                    $repeat = true;
                    break;
                }
            }
            if($repeat == false)
                $groupClient[] = array('id_client' => $cli['id_client'], 'id_pallet' => $cli['id_pallet'], 'quantity' => $cli['quantity']);
        }
        return $groupClient;
    }

    public static function addPercentClient($newGroupClient, $percentE, $idPallet)
    {
        $newResult = array();
        if(sizeof($newGroupClient) > 1)
        {
            // Creamos los %
            // Buscamos el valor total del pallet (hb + qb + eb) piezas.
            $tPcsPallet = Pallet::select('quantity')->where('id', $idPallet)->first();
            
            // Calculamos los % de cada cliente
            foreach($newGroupClient as $item)
            {
                $percent = ($item['quantity'] * 100) / $tPcsPallet->quantity;
                foreach($percentE as $per)
                {
                    //dd($newGroupClient);
                    if($item['id_client'] == $per->id_client)
                    {
                        $updatePercent = SketchPercent::find($per->id);
                        $updatePercent->update([
                            'percent' => $percent
                        ]);
                    }
                    
                }
                
                
                $newResult[] = array('id_client' => $item['id_client'], 'id_pallet' => $item['id_pallet'], 'quantity' => $item['quantity'], 'percent' => $percent);
            }
            return $newResult;
        }
    }
}
