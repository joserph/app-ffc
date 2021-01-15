<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Load;
use App\InvoiceHeader;
use App\LogisticCompany;
use App\Company;
use App\Http\Requests\InvoiceHeaderRequest;
use App\Farm;
use App\Client;
use App\Variety;
use Barryvdh\DomPDF\Facade as PDF;
use App\MasterInvoiceItem;
use Illuminate\Support\Arr;

class InvoiceHeaderController extends Controller
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
        
        // Cabecera de la factura
        $invoiceheaders = InvoiceHeader::orderBy('id', 'DESC')->where('id_load', '=', $code)->first();
        //dd($invoiceheaders);
        // Empresas de Logistica "Activa"
        $lc_active = LogisticCompany::where('active', '=', 'yes')->first();

        // Mi empresa
        $company = Company::first();

        // Datos para items de la factura
        // Fincas
        $farms = Farm::orderBy('name', 'ASC')->pluck('name', 'id');
        // Clientes
        $clients = Client::orderBy('name', 'ASC')->pluck('name', 'id');
        // Variedades
        $varieties = Variety::orderBy('name', 'ASC')->pluck('name', 'id');

        //dd($invoiceheaders);

        return view('masterinvoice.index', compact('load', 
            'invoiceheaders', 
            'lc_active', 
            'company',
            'farms',
            'clients',
            'varieties'));
    }

    public function masterInvoicePdf()
    {
        // Busco el ID de la carga por medio de la URL
        $url = $_SERVER["REQUEST_URI"];
        $arr = explode("?", $url);
        $code = $arr[1];
        $load = Load::find($code);

        // Cabecera de la factura
        $invoiceheaders = InvoiceHeader::orderBy('id', 'DESC')->where('id_load', '=', $code)->first();

        // Empresas de Logistica "Activa"
        $lc_active = LogisticCompany::where('active', '=', 'yes')->first();

        // Mi empresa
        $company = Company::first();

        $invoiceItemsAll = MasterInvoiceItem::select('*')
            ->where('id_load', '=', $code)
            ->with('variety')
            ->with('invoiceh')
            ->join('farms', 'master_invoice_items.id_farm', '=', 'farms.id')
            ->orderBy('farms.name', 'ASC')
            ->get();
        
        foreach($invoiceItemsAll as $item)
        {
            // Buscamos los valores duplicados
            $dupliHawb = MasterInvoiceItem::where('id_load', '=', $code)->where('hawb', '=', $item->hawb)->where('variety_id', '=', $item->variety_id)->count('hawb');
            // Validamos si hay valores duplicados, para agrupar
            if($dupliHawb > 1)
            {
                $fulls = ['fulls' => MasterInvoiceItem::where('id_load', '=', $code)->where('hawb', '=', $item->hawb)->where('variety_id', '=', $item->variety_id)->sum('fulls')];
                $pieces = ['pieces' => MasterInvoiceItem::where('id_load', '=', $code)->where('hawb', '=', $item->hawb)->where('variety_id', '=', $item->variety_id)->sum('pieces')];
                $name = ['name' => $item->name];
                $variety = ['variety' => $item->variety->name];
                $hawb = ['hawb' => $item->hawb];
                $stems = ['stems' => MasterInvoiceItem::where('id_load', '=', $code)->where('hawb', '=', $item->hawb)->where('variety_id', '=', $item->variety_id)->sum('stems')];
                $bunches = ['bunches' => MasterInvoiceItem::where('id_load', '=', $code)->where('hawb', '=', $item->hawb)->where('variety_id', '=', $item->variety_id)->sum('bunches')];
                $price = ['price' => $item->price];
                $total = ['total' => MasterInvoiceItem::where('id_load', '=', $code)->where('hawb', '=', $item->hawb)->where('variety_id', '=', $item->variety_id)->sum('total')];
            }else{
                $fulls = ['fulls' => $item->fulls];
                $pieces = ['pieces' => $item->pieces];
                $name = ['name' => $item->name];
                $variety = ['variety' => $item->variety->name];
                $hawb = ['hawb' => $item->hawb];
                $stems = ['stems' => $item->stems];
                $bunches = ['bunches' => $item->bunches];
                $price = ['price' => $item->price];
                $total = ['total' => $item->total];
            }
            
            $invoiceItemsArray[] = Arr::collapse([$fulls, $pieces, $name, $variety, $hawb, $stems, $bunches, $price, $total]);
            
        }
        $invoiceItems = collect(array_unique($invoiceItemsArray, SORT_REGULAR));
        //dd($invoiceItems);
        $masterInvoicePdf = PDF::loadView('masterinvoice.masterInvoicePdf', compact(
            'load',
            'invoiceheaders',
            'lc_active',
            'company',
            'invoiceItems'
        ));

        return $masterInvoicePdf->stream();
    }

    public function shiptmentConfirmation()
    {
        // Busco el ID de la carga por medio de la URL
        $url = $_SERVER["REQUEST_URI"];
        $arr = explode("?", $url);
        $code = $arr[1];
        $load = Load::find($code);

        // Mi empresa
        $company = Company::first();

        $invoiceItems = MasterInvoiceItem::select('*')
            ->where('id_load', '=', $code)
            ->with('variety')
            ->with('invoiceh')
            ->with('client')
            ->join('farms', 'master_invoice_items.id_farm', '=', 'farms.id')
            ->orderBy('farms.name', 'ASC')
            ->get();
        
        $clientsInInvoice = MasterInvoiceItem::where('id_load', '=', $code)
            ->join('clients', 'master_invoice_items.id_client', '=', 'clients.id')
            ->select('clients.id', 'clients.name')
            ->orderBy('clients.name', 'ASC')
            ->get();

        $clients = collect(array_unique($clientsInInvoice->toArray(), SORT_REGULAR));

        // Total pieces
        $totalPieces = MasterInvoiceItem::where('id_load', '=', $code)->sum('pieces');
        //dd($clients);

        $shiptmentConfirmationPdf = PDF::loadView('masterinvoice.shiptmentConfirmationPdf', compact(
            'invoiceItems',
            'clients',
            'load',
            'company',
            'totalPieces'
        ));

        return $shiptmentConfirmationPdf->stream();
        
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
    public function store(InvoiceHeaderRequest $request)
    {
        $invoiceHeader = InvoiceHeader::create($request->all());
        
        $load = Load::where('id', '=', $invoiceHeader->id_load)->first();

        return redirect()->route('masterinvoices.index', $load->id)
            ->with('status_success', 'Factura creada con éxito');
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
