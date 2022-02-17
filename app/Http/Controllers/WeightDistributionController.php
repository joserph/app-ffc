<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flight;
use App\Distribution;
use App\Client;
use App\Farm;
use App\Variety;
use App\Marketer;
use App\Packing;
use App\WeightDistribution;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


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
            ->with('marketer')
            ->with('weight')
            //->join('weight_distributions', 'weight_distributions.id_distribution', '=', 'distributions.id')
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
        // Pakings
        $packings = Packing::orderBy('description', 'ASC')->pluck('description', 'id');
        // weight Distribution
        $weightDistribution = WeightDistribution::where('id_flight', '=', $flight->id)->with('packing')->get();
        foreach($distributions as $dist)
        {
            //dd($dist->weight[0]['report_w']);
        }
        $dis = $distributions->toArray();
        //dd($dis[0]['weight'][0]['large']);
        //dd($dis);
        return view('weightdistribution.index', compact('flight', 'distributions', 'clients', 'clientsDistribution', 'farms', 'varieties', 'marketers', 'packings', 'weightDistribution'));
    }

    public function weightDistributionExcel($codeDist)
    {
        $flight = Flight::find($codeDist);

        // Buscamos los clientes que esten en esta carga, por el id_load
        $clientsDistr = Distribution::where('id_flight', '=', $codeDist)
            ->join('clients', 'distributions.id_client', '=', 'clients.id')
            ->select('clients.id', 'clients.name')
            ->orderBy('clients.name', 'ASC')
            ->get();
        // Eliminamos los clientes duplicados
        $clientsDistribution = collect(array_unique($clientsDistr->toArray(), SORT_REGULAR));


        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(22);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(65);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(55);

        // Titulo
        $sheet->getStyle('A8:L8')->getFont()->setBold(true);
        $sheet->mergeCells('A8:L8');
        $sheet->getStyle('A8:L8')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A8:L8')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('A8', 'PROYECCION DE PESO ' . $flight->awb);
        // Cabecera
        $sheet->setCellValue('A9', 'HAWB');
        $sheet->setCellValue('B9', 'Reported Weight');
        $sheet->setCellValue('C9', 'Promedio');
        $sheet->setCellValue('D9', 'Largo');
        $sheet->setCellValue('E9', 'Ancho');
        $sheet->setCellValue('F9', 'Alto');
        $sheet->setCellValue('G9', 'Resumen de Clientes');
        $sheet->setCellValue('H9', 'HB');
        $sheet->setCellValue('I9', 'QB');
        $sheet->setCellValue('J9', 'EB');
        $sheet->setCellValue('K9', 'FBX');
        $sheet->setCellValue('L9', 'Observaciones');

        // CLIENTES
        foreach($clientsDistribution as $client)
        {
            $sheet->setCellValue('A10', $client['name']);
        }

        


        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="PROYECCIÓN DE PASO ' . $flight->awb . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
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
        $request['average'] = $request->report_w / $distribution->fulls;

        //dd($request->all());
        $weightDistribution = WeightDistribution::create($request->all());

        return redirect()->route('weight-distribution.index', $distribution->id_flight)
            ->with('status_success', 'Peso agregada con éxito');
        //dd($average);
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
        $weightDistribution = WeightDistribution::find($id);

        $distribution = Distribution::find($request->id_distribution);
        $average = $request->report_w / $distribution->fulls;
        $request['average'] = $request->report_w / $distribution->fulls;

        $weightDistribution->update($request->all());

        return redirect()->route('weight-distribution.index', $distribution->id_flight)
            ->with('status_success', 'Peso editado con éxito');
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
