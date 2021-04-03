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
        
        $pallets = Pallet::where('id_load', '=', $load->id)->get();
        if($pallets)
        {
            $id_pallet = null;
        }else{
            $id_pallet = null;
        }
        
        $last_pallet = Pallet::where('id_load', '=', $load->id)->select('counter')->get()->last();
        //dd($load);
        // Total contenedor
        $total_container = PalletItem::where('id_load', '=', $load)->sum('quantity');
        // Total HB
        $total_hb = PalletItem::where('id_load', '=', $load)->sum('hb');
        // Total QB
        $total_qb = PalletItem::where('id_load', '=', $load)->sum('qb');
        // Total EB
        $total_eb = PalletItem::where('id_load', '=', $load)->sum('eb');
        
        if($last_pallet)
        {
            $counter = $last_pallet->counter + 1;
        }else{
            $counter = 1;
        }
        //dd($counter);
        $number = $code . '-' . $counter;
        $palletItem = PalletItem::where('id_load', '=', $load)->get();
        // Farms
        $farms = Farm::all();
        // Clients
        $clients = Client::all();

        $farmsList = Farm::orderBy('name', 'ASC')->pluck('name', 'id');
        $clientsList = Client::orderBy('name', 'ASC')->pluck('name', 'id');

        //dd($pallets);
        return view('pallets.index', compact('pallets','code', 'farmsList', 'clientsList', 'counter', 'id_pallet', 'number', 'load', 'palletItem', 'farms', 'clients', 'total_container', 'total_hb', 'total_qb', 'total_eb'));
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
        //
    }
}
