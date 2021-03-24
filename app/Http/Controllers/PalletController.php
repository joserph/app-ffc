<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Load;
use App\Pallet;
use App\Farm;
use App\Client;

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
        //$pallets = Pallet::where('id_load', '=', $load)->orderBy('id', '=', 'desc')->get();

        $last_pallet = Pallet::where('id_load', '=', $load)->select('counter')->get()->last();
        
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
        $number = $code . '-' . $counter;
        //$palletItem = PalletItem::where('id_load', '=', $load)->get();
        // Farms
        $farms = Farm::all();
        // Clients
        $clients = Client::all();
        //dd($pallets);
        return view('pallets.index', compact('pallets','code', 'counter', 'number', 'load', 'palletItem', 'farms', 'clients', 'total_container', 'total_hb', 'total_qb', 'total_eb'));
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
        //
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
