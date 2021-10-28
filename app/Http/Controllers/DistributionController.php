<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flight;
use App\Company;
use App\Distribution;
use App\Farm;
use App\Client;
use App\Variety;
use App\Http\Requests\AddDistributionRequest;
use Barryvdh\DomPDF\Facade as PDF;
use App\Color;

class DistributionController extends Controller
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
        // Empresa
        $company = Company::first();
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
        // Clientes
        $clients = Client::orderBy('name', 'ASC')->pluck('name', 'id');
        // Variedades
        $varieties = Variety::orderBy('name', 'ASC')->pluck('name', 'id');
        // Coordinaciones
        $distributions = Distribution::select('*')
            ->where('id_flight', '=', $code)
            ->with('variety')
            ->join('farms', 'distributions.id_farm', '=', 'farms.id')
            ->select('farms.name', 'distributions.*')
            ->orderBy('farms.name', 'ASC')
            ->get();

        return view('distribution.index', compact('flight', 'company', 'clientsDistribution', 'farms', 'clients', 'varieties', 'distributions'));
    }

    public function distributionPdf()
    {
        // Busco el ID de la carga por medio de la URL
        $url = $_SERVER["REQUEST_URI"];
        $arr = explode("?", $url);
        $code = $arr[1];
        // Vuelo actual
        $flight = Flight::find($code);

        // Buscamos los clientes que esten en esta carga, por el id_load
        $clientsDistr = Distribution::where('id_flight', '=', $code)
            ->join('clients', 'distributions.id_client', '=', 'clients.id')
            ->select('clients.id', 'clients.name')
            ->orderBy('clients.name', 'ASC')
            ->get();
        // Eliminamos los clientes duplicados
        $clientsDistribution = collect(array_unique($clientsDistr->toArray(), SORT_REGULAR));
        // Coordinaciones
        $coordinations = Distribution::select('*')
            ->where('id_flight', '=', $code)
            ->with('variety')
            ->with('farm')
            ->join('clients', 'distributions.id_client', '=', 'clients.id')
            ->select('clients.name', 'distributions.*')
            ->orderBy('clients.name', 'ASC')
            /*->join('farms', 'distributions.id_farm', '=', 'farms.id')
            ->select('farms.name', 'distributions.*')
            ->orderBy('farms.name', 'ASC')*/
            ->get();
        //dd($coordinations);
        $colors = Color::where('type', '=', 'client')->get();

        $distributionPdf = PDF::loadView('distribution.distributionPdf', compact(
            'flight', 'clientsDistribution', 'coordinations', 'colors'
        ))->setPaper('A4', 'landscape');
        //dd($farmsItemsLoad);
        return $distributionPdf->stream();
    }

    public function distributionUncoordinatedPdf()
    {
        // Busco el ID de la carga por medio de la URL
        $url = $_SERVER["REQUEST_URI"];
        $arr = explode("?", $url);
        $code = $arr[1];
        // Vuelo actual
        $flight = Flight::find($code);

        // Buscamos los clientes que esten en esta carga, por el id_load
        $clientsDistr = Distribution::where('id_flight', '=', $code)
            ->join('clients', 'distributions.id_client', '=', 'clients.id')
            ->select('clients.id', 'clients.name')
            ->orderBy('clients.name', 'ASC')
            ->get();
        // Eliminamos los clientes duplicados
        $clientsDistribution = collect(array_unique($clientsDistr->toArray(), SORT_REGULAR));
        // Coordinaciones
        $coordinations = Distribution::select('*')
            ->where('id_flight', '=', $code)
            ->with('variety')
            ->with('farm')
            ->join('clients', 'distributions.id_client', '=', 'clients.id')
            ->select('clients.name', 'distributions.*')
            ->orderBy('clients.name', 'ASC')
            /*->join('farms', 'distributions.id_farm', '=', 'farms.id')
            ->select('farms.name', 'distributions.*')
            ->orderBy('farms.name', 'ASC')*/
            ->get();
        //dd($coordinations);
        $colors = Color::where('type', '=', 'client')->get();

        $distributionPdf = PDF::loadView('distribution.distributionUncoordinatedPdf', compact(
            'flight', 'clientsDistribution', 'coordinations', 'colors'
        ))->setPaper('A4', 'landscape');
        //dd($farmsItemsLoad);
        return $distributionPdf->stream();
    }

      public function distributionForDeliveryPdf()
      {
         // Busco el ID de la carga por medio de la URL
        $url = $_SERVER["REQUEST_URI"];
        $arr = explode("?", $url);
        $code = $arr[1];
        // Vuelo actual
        $flight = Flight::find($code);

        // Buscamos los clientes que esten en esta carga, por el id_load
        $clientsDistr = Distribution::where('id_flight', '=', $code)
            ->join('clients', 'distributions.id_client', '=', 'clients.id')
            ->select('clients.id', 'clients.name')
            ->orderBy('clients.name', 'ASC')
            ->get();
        // Eliminamos los clientes duplicados
        $clientsDistribution = collect(array_unique($clientsDistr->toArray(), SORT_REGULAR));
        // Coordinaciones
        $coordinations = Distribution::select('*')
            ->where('id_flight', '=', $code)
            ->with('variety')
            ->with('farm')
            ->join('clients', 'distributions.id_client', '=', 'clients.id')
            ->select('clients.name', 'distributions.*')
            ->orderBy('clients.name', 'ASC')
            /*->join('farms', 'distributions.id_farm', '=', 'farms.id')
            ->select('farms.name', 'distributions.*')
            ->orderBy('farms.name', 'ASC')*/
            ->get();
        //dd($coordinations);
        $colors = Color::where('type', '=', 'client')->get();

        $distributionPdf = PDF::loadView('distribution.distributionForDelivery', compact(
            'flight', 'clientsDistribution', 'coordinations', 'colors'
        ))->setPaper('A4');
        //dd($farmsItemsLoad);
        return $distributionPdf->stream();
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
    public function store(AddDistributionRequest $request)
    {
        //dd($request);
        // calculo de fulls
        $request['fulls'] = ($request['hb'] * 0.5) + ($request['qb'] * 0.25) + ($request['eb'] * 0.125);
        $request['fulls_r'] = ($request['hb_r'] * 0.5) + ($request['qb_r'] * 0.25) + ($request['eb_r'] * 0.125);
        // calculo de piezas
        $request['pieces'] = $request['hb'] + $request['qb'] + $request['eb'];
        $request['pieces_r'] = $request['hb_r'] + $request['qb_r'] + $request['eb_r'];
        // Faltantes 
        $request['missing'] = $request['pieces'] - $request['pieces_r'];
        
        $distrubution = Distribution::create($request->all());

        return redirect()->route('distribution.index', $distrubution->id_flight)
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
        //dd($request->all());
        $distribution = Distribution::find($id);

        $data = request()->validate([
            'hawb'          => 'required|unique:distributions,hawb,' . $distribution->id,
            'pieces'        => '',
            'hb'            => 'required',
            'qb'            => 'required', 
            'eb'            => 'required', 
            'hb_r'          => '',
            'qb_r'          => '',
            'eb_r'          => '',
            'missing'       => '',
            'id_client'     => 'required',
            'id_farm'       => 'required',
            'id_flight'     => 'required',
            'variety_id'    => 'required',
            'id_user'       => '',
            'update_user'   => 'required'
        ]);

        // calculo de fulls
        $request['fulls'] = ($request['hb'] * 0.5) + ($request['qb'] * 0.25) + ($request['eb'] * 0.125);
        $request['fulls_r'] = ($request['hb_r'] * 0.5) + ($request['qb_r'] * 0.25) + ($request['eb_r'] * 0.125);
        // calculo de piezas
        $request['pieces'] = $request['hb'] + $request['qb'] + $request['eb'];
        $request['pieces_r'] = $request['hb_r'] + $request['qb_r'] + $request['eb_r'];
        // Faltantes 
        $request['missing'] = $request['pieces'] - $request['pieces_r'];

        $distribution->update($request->all());
        $flight = Flight::where('id', '=', $distribution->id_flight)->first();

        return redirect()->route('distribution.index', $flight->id)
            ->with('status_success', 'Item de coordinación editada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $distribution = Distribution::find($id);
        $distribution->delete();
        $flight = Flight::where('id', '=', $distribution->id_flight)->first();

        return redirect()->route('distribution.index', $flight->id)
            ->with('status_success', 'Coordinación eliminada con éxito');
    }
}
