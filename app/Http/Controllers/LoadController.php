<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Load;
use App\Http\Requests\AddLoadRequest;
use App\Http\Requests\UpdateLoadRequest;
use App\MasterInvoiceItem;

class LoadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loads = Load::orderBy('id', 'DESC')->paginate(15);
        return view('load.index', compact('loads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('load.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddLoadRequest $request)
    {
        $load = Load::create($request->all());

        return redirect()->route('load.index')
            ->with('status_success', 'Carga creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $load = Load::find($id);
        $loadCount = MasterInvoiceItem::where('id_load', '=', $id)->count();
        $farms = MasterInvoiceItem::select('id_farm')->where('id_load', '=', $id)->get();
        $farmsUnique = $farms->unique('id_farm');
        $farmsCount = $farmsUnique->count();
        //dd($farmsCount);
        return view('load.show', compact('load', 'loadCount', 'farmsCount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $load = Load::find($id);

        return view('load.edit', compact('load'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLoadRequest $request, $id)
    {
        $load = Load::find($id);

        $load->update($request->all());

        return redirect()->route('load.index')
            ->with('status_success', 'La carga se actualizó con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $load = Load::find($id);
        $load->delete();

        return redirect()->route('load.index')
            ->with('status_success', 'Carga eliminada con éxito');
    }
}
