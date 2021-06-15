<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Load;
use App\Sketch;
use App\Pallet;
use Illuminate\Support\Collection;

class SketchController extends Controller
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

        // Buscamos si existe los espacios en la DB.
        $position24 = Sketch::where('id_load', '=', $load->id)->where('space', '>', '0')->get()->last();
        $space = $position24 ? 1 : 0;

        // Buscamos las paletas de la carga actual.
        $pallets = Pallet::where('id_load', $load->id)->get();

        // Buscamos las paletas ya guardadas
        $palletSave = Sketch::where('id_load', $load->id)->select('id_pallet')->get()->toArray();
        //
        // Pallets para select
        //$palletsSelect = Pallet::where('id_load', $load->id)->pluck('number', 'id')->except($palletSave[0]);
        // Sketch
        $sketches = Sketch::where('id_load', $load->id)->select('space')->get()->toArray();
        
        //dd($sketches);
        return view('sketches.index', compact('load', 'pallets', 'sketches', 'space'));
    }

    public static function testView() {
        return "Hello World!";
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
        /*$sketch = Sketch::create($request->all());

        $load = Load::where('id', '=', $sketch->id_load)->get();

        return redirect()->route('sketches.index', $load[0]->id)
            ->with('status_success', 'Espacio agregado con éxito');*/

        $id_load = Load::select('id')->where('id', '=', $request->id_load)->get();

        //dd($id_load[0]->id);
        // Generar espacios
        for($i = 1; $i <= $request->quantity; $i++)
        {
            $sketch = new Sketch();
            $sketch->id_load = $id_load[0]->id;
            $sketch->space = $i;
            $sketch->id_user = $request->id_user;
            $sketch->update_user = $request->update_user;
            $sketch->save();
        }
        $load = Load::where('id', '=', $sketch->id_load)->get();

        return redirect()->route('sketches.index', $load[0]->id)
            ->with('status_success', 'Se generarón ' . $sketch->space . ' espacios con éxito');
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
