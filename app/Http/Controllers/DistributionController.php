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
use App\Marketer;
use App\Http\Requests\UpdateDistributionRequest;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
        // Comercializadores
        $marketers = Marketer::orderBy('name', 'ASC')->pluck('name', 'id');
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
        return view('distribution.index', compact('flight', 'company', 'clientsDistribution', 'farms', 'clients', 'varieties', 'distributions', 'marketers'));
    }

    public function distributionExcel($code)
    {
        $flight = Flight::find($code);
        //dd($flight);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];
        // Titulo
        $sheet->getStyle('A2:P2')->getFont()->setBold(true);
        $sheet->mergeCells('A2:P2');
        $sheet->getStyle('A2:P2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A2:P2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2:P2')->getFont()->setSize(24);
        $sheet->setCellValue('A2', 'COORDINACIONES AÉREAS');
        // Guia
        $sheet->mergeCells('L3:M3');
        $sheet->getStyle('L3:M3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('L3:M3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('L3', 'AWB');

        $sheet->getStyle('N3:O3')->getFont()->setBold(true);
        $sheet->mergeCells('N3:O3');
        $sheet->getStyle('N3:O3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('N3:O3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('N3', str_replace('AWB', '', $flight->awb) );
        // Fecha Salida
        $sheet->mergeCells('L4:M4');
        $sheet->getStyle('L4:M4')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('L4:M4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('L4', 'FECHA SALIDA');

        $sheet->getStyle('N4:O4')->getFont()->setBold(true);
        $sheet->mergeCells('N4:O4');
        $sheet->getStyle('N4:O4')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('N4:O4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('N4', date('d/m/Y', strtotime($flight->date)) );
        // Fecha Llegada
        $sheet->mergeCells('L5:M5');
        $sheet->getStyle('L5:M5')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('L5:M5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('L5', 'FECHA LLEGADA');

        $sheet->getStyle('N5:O5')->getFont()->setBold(true);
        $sheet->mergeCells('N5:O5');
        $sheet->getStyle('N5:O5')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('N5:O5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('N5', date('d/m/Y', strtotime($flight->arrival_date)) );
        // Head coordinado
        $sheet->mergeCells('E7:I7');
        $sheet->getStyle('E7:I7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('E7:I7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('E7:I7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setRGB('F4F804');
        $sheet->getStyle('E7:I7')->applyFromArray($styleArray);
        $sheet->setCellValue('E7', 'COORDINADO');
        // Head RECIBIDO
        $sheet->mergeCells('J7:N7');
        $sheet->getStyle('J7:N7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('J7:N7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('J7:N7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setRGB('10780D');
        $sheet->getStyle('J7:N7')->applyFromArray($styleArray);
        $sheet->setCellValue('J7', 'RECIBIDO');
        // HEAD
        $sheet->setCellValue('B8', 'HAWB');
        $sheet->setCellValue('C8', 'RESUMEN CLIENTES');
        $sheet->setCellValue('D8', 'VARIEDADES');
        $spreadsheet->getActiveSheet()->getStyle('B8:D8')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setRGB('00B0F0');
        $sheet->getStyle('B8:D8')->applyFromArray($styleArray);

        $sheet->setCellValue('E8', 'HB');
        $sheet->setCellValue('F8', 'QB');
        $sheet->setCellValue('G8', 'EB');
        $sheet->setCellValue('H8', 'TOTAL PCS');
        $sheet->setCellValue('I8', 'FBX');
        $spreadsheet->getActiveSheet()->getStyle('E8:I8')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setRGB('F4F804');
        $sheet->getStyle('E8:I8')->applyFromArray($styleArray);

        $sheet->setCellValue('J8', 'HB');
        $sheet->setCellValue('K8', 'QB');
        $sheet->setCellValue('L8', 'EB');
        $sheet->setCellValue('M8', 'TOTAL PCS');
        $sheet->setCellValue('N8', 'FBX');
        $spreadsheet->getActiveSheet()->getStyle('J8:N8')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setRGB('10780D');
        $sheet->getStyle('J8:N8')->applyFromArray($styleArray);

        $sheet->setCellValue('O8', 'DIFERENCIA');
        $sheet->setCellValue('P8', 'OBSERVACIONES');
        $spreadsheet->getActiveSheet()->getStyle('O8:P8')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setRGB('00B0F0');
        $sheet->getStyle('O8:P8')->applyFromArray($styleArray);

        // CLIENTES
        // Buscamos los clientes que esten en esta carga, por el id_load
        $clientsDistr = Distribution::where('id_flight', '=', $code)
            ->join('clients', 'distributions.id_client', '=', 'clients.id')
            ->select('clients.id', 'clients.name')
            ->orderBy('clients.name', 'ASC')
            ->get();
        // Eliminamos los clientes duplicados
        $clientsDistribution = collect(array_unique($clientsDistr->toArray(), SORT_REGULAR));
        // colors
        $colors = Color::where('type', '=', 'client')->get();
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
        
        $fila = 9;
        foreach($clientsDistribution as $key => $client)
        {
            
            foreach($colors as $color)
            {
                if($color->id_type == $client['id'])
                {
                    
                    $colorFila = str_replace('#', '', $color->color);
                    $spreadsheet->getActiveSheet()->getStyle('B'. $fila .':P' .$fila)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setRGB($colorFila);
                    //dd(str_replace('#', '', $color->color));
                    
                    
                }
            }
            $sheet->mergeCells('B'. $fila .':P' .$fila);
            $sheet->getStyle('B'. $fila .':P' .$fila)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('B'. $fila .':P' .$fila)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('B' . $fila, $client['name']);
            
            //dd($client['name']);
            
            
            $filaDos = $fila +1;
            foreach($coordinations as $coord)
            {
                if($coord->id_client == $client['id'])
                {
                    $sheet->setCellValue('B' . $filaDos, $coord->hawb);
                    $sheet->getStyle('B' . $filaDos)->getFont()->setBold(true);
                    $sheet->setCellValue('C' . $filaDos, $coord->hawb);
                    $sheet->getStyle('C' . $filaDos)->getFont()->setBold(true);
                    $sheet->setCellValue('D' . $filaDos, $coord->hawb);
                    $sheet->getStyle('D' . $filaDos)->getFont()->setBold(true);
                    //dd($filaDos);
                    $filaDos++;
                }
                //
            }
            $fila = $filaDos;
        }
        


        






        $writer = new Xlsx($spreadsheet);
        //$writer->save('hello world.xlsx');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="myfile.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
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
        // Duplicate AWB
        if($request['duplicate'] == 'on')
        {
            $request['duplicate'] = 'yes';
        }else{
            $request['duplicate'] = 'no';
        }
        
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
    public function update(UpdateDistributionRequest $request, $id)
    {
        //dd($request->all());
        $distribution = Distribution::find($id);

        /*$data = request()->validate([
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
        ]);*/

        // calculo de fulls
        $request['fulls'] = ($request['hb'] * 0.5) + ($request['qb'] * 0.25) + ($request['eb'] * 0.125);
        $request['fulls_r'] = ($request['hb_r'] * 0.5) + ($request['qb_r'] * 0.25) + ($request['eb_r'] * 0.125);
        // calculo de piezas
        $request['pieces'] = $request['hb'] + $request['qb'] + $request['eb'];
        $request['pieces_r'] = $request['hb_r'] + $request['qb_r'] + $request['eb_r'];
        // Faltantes 
        $request['missing'] = $request['pieces'] - $request['pieces_r'];
        // Duplicate AWB
        if($request['duplicate'] == 'on')
        {
            $request['duplicate'] = 'yes';
        }else{
            $request['duplicate'] = 'no';
        }

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
