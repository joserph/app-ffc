<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Load;
use App\Pallet;
use App\Farm;
use App\Client;
use App\PalletItem;

class PalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Busco el ID de la carga por medio de la URL
        $url = $_SERVER["REQUEST_URI"];
        $arr = explode("?", $url);
        $code = $arr[1];
        $load = Load::find($code);
        
        $pallets = Pallet::where('id_load', '=', $load->id)->orderBy('id', 'DESC')->get();
        
        
        $last_pallet = Pallet::where('id_load', '=', $load->id)->select('counter')->get()->last();
        //dd($load);
        // Total contenedor
        $total_container = PalletItem::where('id_load', '=', $load->id)->sum('quantity');
        // Total HB
        $total_hb = PalletItem::where('id_load', '=', $load->id)->sum('hb');
        // Total QB
        $total_qb = PalletItem::where('id_load', '=', $load->id)->sum('qb');
        // Total EB
        $total_eb = PalletItem::where('id_load', '=', $load->id)->sum('eb');
        
        if($last_pallet)
        {
            $counter = $last_pallet->counter + 1;
        }else{
            $counter = 1;
        }
        //dd($counter);
        $number = $code . '-' . $counter;
        $palletItem = PalletItem::where('id_load', '=', $load->id)->orderBy('farms', 'ASC')->get();
        // Farms
        $farms = Farm::all();
        // Clients
        $clients = Client::all();

        $farmsList = Farm::select('id', 'name')->orderBy('name', 'ASC')->get();
        $clientsList = Client::select('id', 'name')->orderBy('name', 'ASC')->get();

        $resumenCarga = PalletItem::where('id_load', '=', $code)
            ->join('clients', 'pallet_items.id_client', '=', 'clients.id')
            ->select('clients.id', 'clients.name')
            ->orderBy('clients.name', 'ASC')
            ->get();
        // Eliminamos los clientes duplicados
        $resumenCargaAll = collect(array_unique($resumenCarga->toArray(), SORT_REGULAR));
        // Items de carga
        $itemsCarga = PalletItem::select('*')
            ->where('id_load', '=', $code)
            ->join('farms', 'pallet_items.id_farm', '=', 'farms.id')
            ->select('farms.name', 'pallet_items.*')
            ->orderBy('farms.name', 'ASC')
            ->get();


        dd($itemsCarga);
        return view('pallets.index', compact('resumenCargaAll', 'itemsCarga', 'pallets','code', 'farmsList', 'clientsList', 'counter', 'number', 'load', 'palletItem', 'farms', 'clients', 'total_container', 'total_hb', 'total_qb', 'total_eb'));
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
        $pallet = Pallet::create($request->all());
        if($pallet->usda == '1')
        {
            $id_load = Load::select('code')->where('id', '=', $pallet->id_load)->first();
            $pallet->number = $id_load->code .'-USDA';
        }else{
            $pallet->number = $pallet->number . '-' . $pallet->counter;
        }
        $pallet->save();
        $load = Load::where('id', '=', $pallet->id_load)->get();
        
        return redirect()->route('pallets.index', $load[0]->id)
            ->with('info', 'Paleta Guardada con exito');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pallet = Pallet::find($id);
        $pallet->delete();

        $load = Load::where('id', '=', $pallet->id_load)->get();
        
        return redirect()->route('pallets.index', $load[0]->id)
            ->with('info', 'Paleta Eliminada con exito');
    }
}
