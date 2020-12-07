<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MasterInvoiceItem;
use Auth;
use App\Load;

class MasterInvoiceItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $invoiceItems = MasterInvoiceItem::with('farm')->with('variety')->get();
        dd($invoiceItems);
        return $invoiceItems;
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
        // Carga
        //dd($request->id_invoiceh);
        //dd($request->bunches);
        
        MasterInvoiceItem::create([
            'id_invoiceh'       => $request->id_invoiceh,
            'id_client'         => $request->id_client,
            'id_farm'           => $request->id_farm,
            'id_load'           => $request->id_load,
            'variety_id'        => $request->variety_id,
            'hawb'              => $request->hawb,
            'pieces'            => $request->pieces,
            'hb'                => $request->hb,
            'qb'                => $request->qb,
            'eb'                => $request->eb ,
            'stems'             => $request->stems,
            'price'             => $request->price,
            'bunches'           => $request->bunches,
            'fulls'             => $request->fulls,    
            'total'             => $request->total,
            'id_user'           => $request->id_user,
            'update_user'       => $request->update_user,
            'stems_p_bunches'   => $request->stems_p_bunches
        ]);

        return;
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
        $invoiceItems = MasterInvoiceItem::findOrFail($id);

        return $invoiceItems;
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
        $invoiceItems = MasterInvoiceItem::findOrFail($id);
        $invoiceItems->delete();
    }
}
