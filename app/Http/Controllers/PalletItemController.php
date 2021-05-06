<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PalletItem;
use App\Farm;
use App\Pallet;
use App\Load;
use Barryvdh\DomPDF\Facade as PDF;

class PalletItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        if($request->piso == 'value')
        {
            $request->piso = 1;
        }else{
            $request->piso = 0;
        }
        $palletitem = PalletItem::create([
            'id_user' => $request->id_user,
            'update_user' => $request->update_user,
            'id_load' => $request->id_load,
            'id_pallet' => $request->id_pallet,
            'id_farm' => $request->id_farm,
            'id_client' => $request->id_client,
            'hb' => $request->hb,
            'qb' => $request->qb,
            'eb' => $request->eb,
            'quantity' => $request->quantity,
            'piso' => $request->piso
        ]);
        $farm = Farm::select('name')->where('id', '=', $palletitem->id_farm)->first();
        $palletitem->farms = $farm->name;
        $palletitem->save();

        // Crear tabla agrupada
        /*$palletitem_pdf = PalletItemsPdf::where('id_load', '=', $palletitem->id_load)->where('id_client', '=', $palletitem->id_client)->where('id_farm', '=', $palletitem->id_farm)->first();
        //dd($palletitem_pdf);
        if($palletitem_pdf)
        {
            $palletitem_pdf->hb += $palletitem->hb;
            $palletitem_pdf->qb += $palletitem->qb;
            $palletitem_pdf->eb += $palletitem->eb;
            $palletitem_pdf->quantity += $palletitem->quantity; 
            $palletitem_pdf->fulls = ($palletitem_pdf->hb * 0.50) + ($palletitem_pdf->qb * 0.25) + ($palletitem_pdf->eb * 0.125);
            $pos = strpos($palletitem_pdf->items_id_pallets, $palletitem->id);
            //dd($pos);
            if(!$pos)
            {
                $palletitem_pdf->items_id_pallets = $palletitem_pdf->items_id_pallets . $palletitem->id . ',';
            }
            $palletitem_pdf->save();
        }else{
            $palletitem_pdf = PalletItemsPdf::create($request->all());
            $farm = Farm::select('name')->where('id', '=', $palletitem_pdf->id_farm)->first();
            $palletitem_pdf->farms = $farm->name;
            $palletitem_pdf->fulls = ($palletitem_pdf->hb * 0.50) + ($palletitem_pdf->qb * 0.25) + ($palletitem_pdf->eb * 0.125);
            $palletitem_pdf->items_id_pallets = $palletitem->id . ',';
            $palletitem_pdf->save();
        }*/
        
        $pallet = Pallet::where('id', '=', $palletitem->id_pallet)->get();
        $load = Load::where('id', '=', $pallet[0]->id_load)->get();

        // Total paleta
        $total_pallet = PalletItem::where('id_pallet', '=', $palletitem->id_pallet)->sum('quantity');
        //dd($total_pallet);
        $pallet_update = Pallet::find($palletitem->id_pallet);
        $pallet_update->quantity = $total_pallet;
        $pallet_update->save();


        //dd($load[0]->id);
        return redirect()->route('pallets.index', $load[0]->id)
            ->with('info', 'Item Guardado con exito');
    }

    public function palletitemsPdf()
    {
        // Busco el ID de la carga por medio de la URL
        $url = $_SERVER["REQUEST_URI"];
        $arr = explode("?", $url);
        $code = $arr[1];
        $load = Load::find($code);

        $resumenCarga = PalletItem::where('id_load', '=', $code)
            ->join('clients', 'pallet_items.id_client', '=', 'clients.id')
            ->select('clients.id', 'clients.name')
            ->orderBy('clients.name', 'ASC')
            ->get();
        // Eliminamos los clientes duplicados
        $resumenCargaAll = collect(array_unique($resumenCarga->toArray(), SORT_REGULAR));

        // Items de carga
        $itemsCargaAll = PalletItem::select('*')
            ->where('id_load', '=', $code)
            ->join('farms', 'pallet_items.id_farm', '=', 'farms.id')
            ->select('farms.name', 'pallet_items.*')
            ->orderBy('farms.name', 'ASC')
            ->get();

        $itemsCarga = PalletItem::groupEqualsItemsCargas($itemsCargaAll, $code);

        //dd($itemsCarga);

        $palletitemsPdf = PDF::loadView('palletitems.palletitemsPdf', compact(
            'itemsCarga',
            'load',
            'resumenCargaAll'
        ))->setPaper('A4');

        
        return $palletitemsPdf->stream();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $palletItem = PalletItem::find($id);
        $palletItem->update($request->all());

        $load = Load::where('id', '=', $palletItem->id_load)->get();

        return redirect()->route('pallets.index', $load[0]->id)
            ->with('info', 'Item Actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $palletItem = PalletItem::find($id);
        $palletItem->delete();

        $load = Load::where('id', '=', $palletItem->id_load)->get();

        return redirect()->route('pallets.index', $load[0]->id)
            ->with('info', 'Item eliminado con exito');
    }
}
