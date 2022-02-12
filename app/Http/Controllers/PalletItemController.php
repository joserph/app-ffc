<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PalletItem;
use App\Farm;
use App\Pallet;
use App\Load;
use App\SketchPercent;
use Barryvdh\DomPDF\Facade as PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Color;
use App\Client;

class PalletItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //dd($request->all());
        if($request->piso == 'value')
        {
            $request->piso = 1;
        }else{
            $request->piso = 0;
        }
        $palletitem = PalletItem::create([
            'id_user' => $request->id_user,
            'update_user' => $request->update_user,
            'id_load' => $request->id_load,
            'id_pallet' => $request->id_pallet,
            'id_farm' => $request->id_farm,
            'id_client' => $request->id_client,
            'hb' => $request->hb,
            'qb' => $request->qb,
            'eb' => $request->eb,
            'quantity' => $request->quantity,
            'piso' => $request->piso
        ]);
        $farm = Farm::select('name')->where('id', '=', $palletitem->id_farm)->first();
        $palletitem->farms = $farm->name;
        $palletitem->save();

        $pallet = Pallet::where('id', '=', $palletitem->id_pallet)->get();
        $load = Load::where('id', '=', $pallet[0]->id_load)->get();

        // Total paleta
        // Actualizar total de la paleta
        PalletItem::updateTotalPallet($palletitem->id_pallet);

        return redirect()->route('pallets.index', $load[0]->id)
            ->with('info', 'Item Guardado con exito');
    }

    public function palletitemsExcel($codeLoad)
    {
        
        $load = Load::find($codeLoad);
        // CLIENTES
        $resumenCarga = PalletItem::where('id_load', '=', $codeLoad)
            ->join('clients', 'pallet_items.id_client', '=', 'clients.id')
            ->select('clients.id', 'clients.name')
            ->orderBy('clients.name', 'ASC')
            ->get();
        $colors = Color::where('type', '=', 'client')->get();
        // Eliminamos los clientes duplicados
        $clientsLoad = collect(array_unique($resumenCarga->toArray(), SORT_REGULAR));
        // PALLETS
        $pallets = Pallet::where('id_load', '=', $codeLoad)->orderBy('id', 'ASC')->get();
        $palletItem = PalletItem::where('id_load', '=', $codeLoad)->with('client')->with('farm')->orderBy('farms', 'ASC')->get();
        // Farms
        //$farms = Farm::all();
        // Clients
        //$clients = Client::all();

        //dd($palletItem);
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
        $style = [
            'alignment' => array(
                'wrapText' => TRUE,
                'textRotation' => '90',
                'readorder' => \PhpOffice\PhpSpreadsheet\Style\Alignment::READORDER_RTL,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ),
        ];

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(26);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(4);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(2);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(8);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(21);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(8);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(21);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(5);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(7);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(50);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(24);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(5);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(5);
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(5);
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(5);
        $spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(45);
        $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(5);
        $spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(5);
        $spreadsheet->getActiveSheet()->getColumnDimension('S')->setWidth(5);

        //$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(200);
        //MARCACIONES
        $sheet->getStyle('A2:B2')->getFont()->setBold(true);
        $sheet->mergeCells('A2:B2');
        $sheet->getStyle('A2:B2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A2:B2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2:B2')->getFont()->setSize(11);
        $sheet->getStyle('A2:B2')->applyFromArray($styleArray);
        $sheet->setCellValue('A2', 'MARCACIONES');
        
        // LOOP
        $fila = 3;
        foreach($clientsLoad as $client)
        {
            $sheet->setCellValue('A' . $fila, $client['name']);
            foreach($colors as $color)
            {
                if($color->id_type == $client['id'])
                {
                    
                    $colorFila = str_replace('#', '', $color->color);
                    $spreadsheet->getActiveSheet()->getStyle('B'. $fila)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setRGB($colorFila);
                    $sheet->getStyle('A' . $fila . ':B' . $fila)->applyFromArray($styleArray);
                }
            }

            $fila++;
           
        }
        $blCell = $fila;
        $sheet->mergeCells('A' . $blCell . ':B' . ($blCell+20));
        //$sheet->getStyle('A' . $blCell)->getAlignment()->setTextRotation(0);
        /*$sheet->getStyle('A' . $blCell . ':B' . ($blCell+20))->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A' . $blCell . ':B' . ($blCell+20))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);*/
        $sheet->getStyle('A' . $blCell . ':B' . ($blCell+20))->applyFromArray($style);
        $sheet->getStyle('A' . $blCell . ':B' . ($blCell+20))->getFont()->setSize(28);
        $sheet->setCellValue('A' . $blCell, $load->bl);
        
        // PLANO
        $sheet->getStyle('D2:G69')->getFont()->setBold(true);
        $sheet->mergeCells('D2:E2');
        $sheet->getStyle('D2:G69')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('D2:G69')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D2:G69')->applyFromArray($styleArray);
        $sheet->setCellValue('D2', 'LADO CHOFER');

        //$sheet->getStyle('F2:G2')->getFont()->setBold(true);
        $sheet->mergeCells('F2:G2');
        /*$sheet->getStyle('F2:G2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('F2:G2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('F2:G2')->applyFromArray($styleArray);*/
        $sheet->setCellValue('F2', 'LADO CO-PILOTO');

        $sheet->setCellValue('D3', 'PALETA');
        $sheet->setCellValue('E3', 'CLIENTE');
        $sheet->setCellValue('F3', 'PALETA');
        $sheet->setCellValue('G3', 'CLIENTE');

        $i = 'D';
        for($i; $i <= 'G'; $i++)
        {
            
            for($f = 4; $f <= 69; $f+=6)
            {
                //dd('F= ' . $f . 'Letra =' . $i);
                $sheet->mergeCells($i . $f . ':' . $i . ($f + 5));
            }
            //$sheet->setCellValue($i . $numCellTotal, '=' . $cadena);
        }

        // PALLETS
        $sheet->mergeCells('I1:N1');
        $sheet->getStyle('I1:N3')->getFont()->setBold(true);
        $sheet->getStyle('I1:N3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('I1:N3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('I1:N3')->applyFromArray($styleArray);

        $sheet->getStyle('I1:N1')->getFont()->setSize(20);
        $spreadsheet->getActiveSheet()->getStyle('I1:N1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setRGB('C6E0B4');
        $sheet->setCellValue('I1', $load->bl);

        $sheet->mergeCells('I2:N2');
        $sheet->setCellValue('I2', 'PIEZAS EMBARCADAS');
        $sheet->setCellValue('I3', 'PALETA');
        $sheet->setCellValue('J3', 'FINCA');
        $sheet->setCellValue('K3', 'CLIENTE');
        $sheet->setCellValue('L3', 'HB');
        $sheet->setCellValue('M3', 'QB');
        $sheet->setCellValue('N3', 'EB');
        // LOOP PALETAS Y FINCAS
        /*$k = 'I';
        for($k; $k <= 'N'; $k++)
        {
            $j = 4;
            foreach($pallets as $pallet)
            {
                
                foreach($palletItem as $pItem)
                {
                    if($pallet->id == $pItem->id_pallet)
                    {
                        dd($k . $j);
                        $sheet->setCellValue($k . $j, $pallet->counter);
                        $sheet->setCellValue($k . $j, $pItem->farm->name);
                    }
                }
                
                $j++;
            }
            
        }*/
        $j = 4;
        $count = 0;
        foreach($pallets as $pallet)
        {
            foreach($palletItem as $pItem)
            {
                $k = 'I';
                if($pallet->id == $pItem->id_pallet)
                {
                    
                    for($k; $k <= 'N'; $k++)
                    {
                        //dd($pallet->counter);
                        if($count != $pallet->counter)
                        {
                            $sheet->getStyle($k . $j)->applyFromArray($styleArray);

                            $sheet->setCellValue($k . $j, $pallet->counter);
                        }
                        $count = $pallet->counter;
                        $k++;
                        $sheet->getStyle($k . $j)->applyFromArray($styleArray);
                        $sheet->setCellValue($k . $j, $pItem->farm->name);
                        $k++;
                        $sheet->getStyle($k . $j)->applyFromArray($styleArray);
                        $sheet->setCellValue($k . $j, $pItem->client->name);
                        $k++;
                        $sheet->getStyle($k . $j)->applyFromArray($styleArray);
                        $sheet->setCellValue($k . $j, $pItem->hb);
                        $k++;
                        $sheet->getStyle($k . $j)->applyFromArray($styleArray);
                        $sheet->setCellValue($k . $j, $pItem->qb);
                        $k++;
                        $sheet->getStyle($k . $j)->applyFromArray($styleArray);
                        $sheet->setCellValue($k . $j, $pItem->eb);
                    }
                    $j++;
                }
                //$sheet->setCellValue($k . $j, '--');
            }
            $space = $j;
            //
            /*$spreadsheet->getActiveSheet()->getStyle('B'. $space .':P' .$space)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setRGB('FFFFFF');*/
            $sheet->setCellValue('I' . $space, '');
            $j = $space + 1;
            
        }
        
        



        $writer = new Xlsx($spreadsheet);
        //$writer->save('hello world.xlsx');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="PLANO DE CARGA ' . $load->bl . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }


    public function palletitemsPdf()
    {
        // Busco el ID de la carga por medio de la URL
        $url = $_SERVER["REQUEST_URI"];
        $arr = explode("?", $url);
        $code = $arr[1];
        $load = Load::find($code);

        $resumenCarga = PalletItem::where('id_load', '=', $code)
            ->join('clients', 'pallet_items.id_client', '=', 'clients.id')
            ->select('clients.id', 'clients.name')
            ->orderBy('clients.name', 'ASC')
            ->get();
        // Eliminamos los clientes duplicados
        $resumenCargaAll = collect(array_unique($resumenCarga->toArray(), SORT_REGULAR));

        // Items de carga
        $itemsCargaAll = PalletItem::select('*')
            ->where('id_load', '=', $code)
            ->join('farms', 'pallet_items.id_farm', '=', 'farms.id')
            ->select('farms.name', 'pallet_items.*')
            ->orderBy('farms.name', 'ASC')
            ->get();

        $itemsCarga = PalletItem::groupEqualsItemsCargas($itemsCargaAll, $code);

        //dd($itemsCarga);

        $palletitemsPdf = PDF::loadView('palletitems.palletitemsPdf', compact(
            'itemsCarga',
            'load',
            'resumenCargaAll'
        ))->setPaper('A4');

        
        return $palletitemsPdf->stream();
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
        $palletItem = PalletItem::find($id);
        
        $palletItem->update($request->all());

        $load = Load::where('id', '=', $palletItem->id_load)->get();

        // Actualizar total de la paleta
        PalletItem::updateTotalPallet($palletItem->id_pallet);

        return redirect()->route('pallets.index', $load[0]->id)
            ->with('info', 'Item Actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $palletItem = PalletItem::find($id);
        $palletItem->delete();

        $load = Load::where('id', '=', $palletItem->id_load)->get();

        // Actualizar total de la paleta
        PalletItem::updateTotalPallet($palletItem->id_pallet);

        return redirect()->route('pallets.index', $load[0]->id)
            ->with('info', 'Item eliminado con exito');
    }
}
