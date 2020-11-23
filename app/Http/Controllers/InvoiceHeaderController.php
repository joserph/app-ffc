<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Load;
use App\InvoiceHeader;
use App\LogisticCompany;
use App\Company;

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
        $div = explode("/", $url);
        $code1 = $div[2];
        $load = Load::find($code1);

        // Cabecera de la factura
        $invoiceheaders = InvoiceHeader::orderBy('id', 'DESC')->where('id_load', '=', $code1)->first();

        // Empresas de Logistica "Activa"
        $lc_active = LogisticCompany::where('active', '=', 'yes')->first();

        // Mi empresa
        $company = Company::first();

        //dd($company);

        return view('masterinvoice.index', compact('load', 'invoiceheaders', 'lc_active', 'company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masterinvoice.formHeader'); // prueba para subir app a heroku
        
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
