<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flight;
use App\Distribution;
use App\Client;
use App\Farm;
use App\Variety;
use App\Marketer;


class WeightDistributionController extends Controller
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
        // Vuelo actual
        $flight = Flight::find($code);
        // Coordinaciones
        $distributions = Distribution::select('*')
            ->where('id_flight', '=', $code)
            ->with('variety')
            ->WITH('marketer')
            ->join('farms', 'distributions.id_farm', '=', 'farms.id')
            ->select('farms.name', 'distributions.*')
            ->orderBy('farms.name', 'ASC')
            ->get();
        //dd($distributions);
        $clients = Client::orderBy('name', 'ASC')->pluck('name', 'id');
        // Buscamos los clientes que esten en esta carga, por el id_load
        $clientsDistr = Distribution::where('id_flight', '=', $code)
            ->join('clients', 'distributions.id_client', '=', 'clients.id')
            ->select('clients.id', 'clients.name')
            ->orderBy('clients.name', 'ASC')
            ->get();
        // Eliminamos los clientes duplicados
        $clientsDistribution = collect(array_unique($clientsDistr->toArray(), SORT_REGULAR));
        // Fincas
        $farms = Farm::orderBy('name', 'ASC')->pluck('name', 'id');
        // Variedades
        $varieties = Variety::orderBy('name', 'ASC')->pluck('name', 'id');
        // Comercializadores
        $marketers = Marketer::orderBy('name', 'ASC')->pluck('name', 'id');
        //dd($clients);
        return view('weightdistribution.index', compact('flight', 'distributions', 'clients', 'clientsDistribution', 'farms', 'varieties', 'marketers'));
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
        $distribution = Distribution::find($request->id_distribution);
        $average = $request->report_w / $distribution->fulls;
        
        dd($average);
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
