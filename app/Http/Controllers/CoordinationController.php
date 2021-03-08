<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Farm;
use App\Client;
use App\Variety;
use App\Load;
use App\Company;
use App\Coordination;
use App\Http\Requests\CoordinationRequest;

class CoordinationController extends Controller
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

        $coordinations = Coordination::select('*')
            ->where('id_load', '=', $code)
            ->with('variety')
            ->join('farms', 'coordinations.id_farm', '=', 'farms.id')
            ->select('farms.name', 'coordinations.*')
            ->orderBy('farms.name', 'ASC')
            ->get();
        // Fincas
        $farms = Farm::orderBy('name', 'ASC')->pluck('name', 'id');
        // Clientes
        $clients = Client::orderBy('name', 'ASC')->pluck('name', 'id');
        // Variedades
        $varieties = Variety::orderBy('name', 'ASC')->pluck('name', 'id');
        
        // Empresa
        $company = Company::first();
        // Buscamos los clientes que esten en esta carga, por el id_load
        $clientsCoord = Coordination::where('id_load', '=', $code)
            ->join('clients', 'coordinations.id_client', '=', 'clients.id')
            ->select('clients.id', 'clients.name')
            ->orderBy('clients.name', 'ASC')
            ->get();
        // Eliminamos los clientes duplicados
        $clientsCoordination = collect(array_unique($clientsCoord->toArray(), SORT_REGULAR));

        //dd($coordinations);
        return view('coordination.index', compact('farms', 'clients', 'varieties', 'load', 'company', 'coordinations', 'clientsCoordination'));
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
    public function store(CoordinationRequest $request)
    {
        // calculo de fulls
        $request['fulls'] = ($request['hb'] * 0.5) + ($request['qb'] * 0.25) + ($request['eb'] * 0.125);
        $request['fulls_r'] = ($request['hb_r'] * 0.5) + ($request['qb_r'] * 0.25) + ($request['eb_r'] * 0.125);
        // calculo de piezas
        $request['pieces'] = $request['hb'] + $request['qb'] + $request['eb'];
        $request['pieces_r'] = $request['hb_r'] + $request['qb_r'] + $request['eb_r'];
        // Faltantes 
        $request['missing'] = $request['pieces'] - $request['pieces_r'];
        
        $coordination = Coordination::create($request->all());

        return redirect()->route('coordination.index', $coordination->id_load)
            ->with('status_success', 'Coordinación guardada con éxito');
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
