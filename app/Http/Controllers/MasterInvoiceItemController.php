<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MasterInvoiceItem;
use Auth;
use App\Load;
use App\InvoiceHeader;
use App\Http\Requests\AddMasterInvoiceItemRequest;

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
    public function store(AddMasterInvoiceItemRequest $request)
    {
        // Carga
        //dd($request->id_invoiceh);
        //dd($request->bunches);
        
        $masterInvoiceHeader = MasterInvoiceItem::create([
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
            'stems_p_bunches'   => $request->stems_p_bunches,
            'fa_cl_de'          => $request->fa_cl_de
        ]);
        // Actualizamos los totales en la table Invoice Header
        $fulls = MasterInvoiceItem::select('fulls')->where('id_load', '=', $masterInvoiceHeader->id_load)->sum('fulls');
        $bunches = MasterInvoiceItem::select('bunches')->where('id_load', '=', $masterInvoiceHeader->id_load)->sum('bunches');
        $pieces = MasterInvoiceItem::select('pieces')->where('id_load', '=', $masterInvoiceHeader->id_load)->sum('pieces');
        $stems = MasterInvoiceItem::select('stems')->where('id_load', '=', $masterInvoiceHeader->id_load)->sum('stems');
        $total_t = MasterInvoiceItem::select('total')->where('id_load', '=', $masterInvoiceHeader->id_load)->sum('total');
        $invoiceHeader = InvoiceHeader::find($masterInvoiceHeader->id_invoiceh);
        $invoiceHeader->update([
            'total_fulls'   => $fulls,
            'total_bunches' => $bunches,
            'total_pieces'  => $pieces,
            'total_stems'   => $stems,
            'total'         => $total_t
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
