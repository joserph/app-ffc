<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Coordination extends Model
{
    protected $fillable = [
        'hawb',
        'pieces',
        'hb',
        'qb', 
        'eb', 
        'hb_r',
        'qb_r',
        'eb_r',
        'missing',
        'id_client',
        'id_farm',
        'id_load',
        'variety_id',
        'id_user',
        'update_user',
        'fulls',
        'pieces_r',
        'fulls_r',
        'returns',
        'id_marketer',
        'observation'
    ];

    public function farm()
    {
        return $this->belongsTo('App\Farm', 'id_farm');
    }

    public function client()
    {
        return $this->belongsTo('App\Client', 'id_client');
    }

    public function variety()
    {
        return $this->belongsTo('App\Variety', 'variety_id');
    }

    public function marketer()
    {
        return $this->belongsTo('App\Marketer', 'id_marketer');
    }

    public static function excel($load, $clientsDistribution, $coordinations)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        //Page margins
        $sheet->getPageMargins()->setTop(0.5);
        $sheet->getPageMargins()->setRight(0.75);
        $sheet->getPageMargins()->setLeft(0.75);
        $sheet->getPageMargins()->setBottom(1);
        //Use fit to page for the horizontal direction
        $sheet->getPageSetup()->setFitToWidth(1);
        $sheet->getPageSetup()->setFitToHeight(0);
        // Horientacion de la pagina
        $spreadsheet->getActiveSheet()->getPageSetup()
        ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Bordes finos
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(2);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(50);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(13);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(6);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(6);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(6);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(6);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(8);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(6);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(6);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(6);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(6);
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(8);
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(6);
        $spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(11);
        $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(48);
        $spreadsheet->getActiveSheet()->getRowDimension('8')->setRowHeight(30);

        // Número de paginas
        $spreadsheet->getActiveSheet()->getHeaderFooter()
            ->setOddFooter('&RPagina &P de &N');

        $letra = 'A';
        // Calculo de las caldas en blanco
        $total_lineas = $coordinations->count() + ($clientsDistribution->count() * 3) + 5 + 9;
        for($letra; $letra <= 'Q'; $letra++)
        {
            $spreadsheet->getActiveSheet()->getStyle($letra . '1:' . $letra . $total_lineas)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setRGB('FFFFFF');
        }

        $sheet->getStyle('B7:Q7')->getFont()->setBold(true);
        $sheet->getStyle('B8:Q8')->getFont()->setBold(true);
        $sheet->getStyle('B8:Q8')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('B8:Q8')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        // Titulo
        $sheet->getStyle('B2:Q2')->getFont()->setBold(true);
        $sheet->mergeCells('B2:Q2');
        $sheet->getStyle('B2:Q2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('B2:Q2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B2:Q2')->getFont()->setSize(24);
        $sheet->setCellValue('B2', 'COORDINACIÓN MARÍTIMA');
        // BL
        $sheet->getStyle('B3:Q3')->getFont()->setBold(true);
        $sheet->mergeCells('B3:Q3');
        $sheet->getStyle('B3:Q3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('B3:Q3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B3:Q3')->getFont()->setSize(20);
        $sheet->setCellValue('B3', $load->bl . ' - #' . $load->shipment);
        // Empresa de Logistica
        $sheet->getStyle('B4:Q4')->getFont()->setBold(true);
        $sheet->mergeCells('B4:Q4');
        $sheet->getStyle('B4:Q4')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('B4:Q4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        if(isset($load->logistic_company->name))
        {
            $sheet->setCellValue('B4', $load->logistic_company->name);
        }else{
            $sheet->setCellValue('B4', '');
        }
        // Head coordinado
        $sheet->mergeCells('E7:I7');
        $sheet->getStyle('E7:I7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('E7:I7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('E7:I7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setRGB('d7f4fe');
        $sheet->getStyle('E7:I7')->applyFromArray($styleArray);
        $sheet->setCellValue('E7', 'COORDINADO');
        // Head RECIBIDO
        $sheet->mergeCells('J7:N7');
        $sheet->getStyle('J7:N7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('J7:N7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('J7:N7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setRGB('b7ffe9');
        $sheet->getStyle('J7:N7')->applyFromArray($styleArray);
        $sheet->setCellValue('J7', 'RECIBIDO');
        // HEAD
        $sheet->setCellValue('B8', 'FINCA');
        $sheet->setCellValue('C8', 'HAWB');
        $sheet->setCellValue('D8', 'VARIEDAD');
        $spreadsheet->getActiveSheet()->getStyle('B8:D8')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setRGB('f0f0f0');
        $sheet->getStyle('B8:D8')->applyFromArray($styleArray);

        $sheet->setCellValue('E8', 'PCS');
        $sheet->setCellValue('F8', 'HB');
        $sheet->setCellValue('G8', 'QB');
        $sheet->setCellValue('H8', 'EB');
        $sheet->setCellValue('I8', 'FULL');
        $spreadsheet->getActiveSheet()->getStyle('E8:I8')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setRGB('d7f4fe');
        $sheet->getStyle('E8:I8')->applyFromArray($styleArray);

        $sheet->setCellValue('J8', 'PCS');
        $sheet->setCellValue('K8', 'HB');
        $sheet->setCellValue('L8', 'QB');
        $sheet->setCellValue('M8', 'EB');
        $sheet->setCellValue('N8', 'FULL');
        $spreadsheet->getActiveSheet()->getStyle('J8:N8')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setRGB('b7ffe9');
        $sheet->getStyle('J8:N8')->applyFromArray($styleArray);

        $sheet->setCellValue('O8', 'DEV');
        $spreadsheet->getActiveSheet()->getStyle('O8')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setRGB('ffbcc7');
        $sheet->setCellValue('P8', 'FALTANTES');
        $spreadsheet->getActiveSheet()->getStyle('P8')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setRGB('feffb5');
        $sheet->setCellValue('Q8', 'OBSERVACIONES');
        $spreadsheet->getActiveSheet()->getStyle('Q8')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setRGB('00B0F0');
        $sheet->getStyle('O8:Q8')->applyFromArray($styleArray);

        $fila = 9;
        $arrSubTotal = array();
        foreach($clientsDistribution as $key => $client)
        {
            $sheet->mergeCells('B'. $fila .':Q' .$fila);
            $sheet->getStyle('B'. $fila .':Q' .$fila)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('B'. $fila .':Q' .$fila)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('B'. $fila .':Q' .$fila)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getRowDimension($fila)->setRowHeight(25);
            $sheet->getStyle('B'. $fila .':Q' .$fila)->getFont()->setSize(18);
            $sheet->setCellValue('B' . $fila, $client['name']);
            $sheet->getStyle('B'. $fila .':Q' .$fila)->getFont()->setBold(true);
            
            $filaDos = $fila + 1;
            
            $indice = 0;
            foreach($coordinations as $key => $coord)
            {
                if($coord->id_client == $client['id'])
                {
                    $sheet->getStyle('C'. $filaDos)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $sheet->getStyle('C'. $filaDos)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle('D'. $filaDos)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $sheet->getStyle('D'. $filaDos)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle('P'. $filaDos)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $sheet->getStyle('P'. $filaDos)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle('Q'. $filaDos)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $sheet->getStyle('Q'. $filaDos)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle('C'. $filaDos)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $spreadsheet->getActiveSheet()->getRowDimension($filaDos)->setRowHeight(20);
                    
                    $spreadsheet->getActiveSheet()->getStyle('Q'. $filaDos)
                        ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
                    
                    $sheet->getStyle('E'. $filaDos .':O' .$filaDos)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $sheet->getStyle('E'. $filaDos .':O' .$filaDos)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    $spreadsheet->getActiveSheet()->getStyle('I' . $filaDos)->getNumberFormat()->setFormatCode('#,##0.000');
                    $spreadsheet->getActiveSheet()->getStyle('N' . $filaDos)->getNumberFormat()->setFormatCode('#,##0.000');

                    $sheet->setCellValue('B' . $filaDos, $coord->farm_name);
                    $sheet->setCellValue('C' . $filaDos, $coord->hawb);
                    $sheet->setCellValue('D' . $filaDos, $coord->variety->name);
                    $sheet->setCellValue('E' . $filaDos, '=SUM(F' . $filaDos . ':H' . $filaDos . ')');
                    $sheet->setCellValue('F' . $filaDos, $coord->hb);
                    $sheet->setCellValue('G' . $filaDos, $coord->qb);
                    $sheet->setCellValue('H' . $filaDos, $coord->eb);
                    $sheet->setCellValue('I' . $filaDos, '=+(F' . $filaDos . '*0.5)+(G' . $filaDos . '*0.25)+(H' . $filaDos . '*0.125)');
                    $sheet->setCellValue('J' . $filaDos, '=SUM(K' . $filaDos . ':M' . $filaDos . ')');
                    $sheet->setCellValue('K' . $filaDos, $coord->hb_r);
                    $sheet->setCellValue('L' . $filaDos, $coord->qb_r);
                    $sheet->setCellValue('M' . $filaDos, $coord->eb_r);
                    $sheet->setCellValue('N' . $filaDos, '=+(K' . $filaDos . '*0.5)+(L' . $filaDos . '*0.25)+(M' . $filaDos . '*0.125)');
                    $sheet->setCellValue('O' . $filaDos, $coord->returns);
                    $sheet->setCellValue('P' . $filaDos, '=+E' . $filaDos . '-J' . $filaDos);
                    
                    if($coord->id_marketer)
                    {
                        $observation = 'COMPRA DE ' . $coord->marketer->name . ' (' . $coord->observation . ')';
                    }else{
                        $observation = $coord->observation;
                    }
                    $sheet->setCellValue('Q' . $filaDos, $observation);
                    $sheet->getStyle('B'. $filaDos .':Q' .$filaDos)->applyFromArray($styleArray);
                    
                    $filaDos++;
                }
            }
            // Imprimimos SubTotales
            $numCell = $filaDos;
            
            $sheet->mergeCells('B'. $numCell .':D' .$numCell);
            $sheet->getStyle('B'. $numCell .':D' .$numCell)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('B'. $numCell .':D' .$numCell)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('E'. $numCell .':P' .$numCell)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('E'. $numCell .':P' .$numCell)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle('E'. $numCell .':I' .$numCell)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setRGB('d7f4fe');
            $spreadsheet->getActiveSheet()->getStyle('J'. $numCell .':N' .$numCell)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setRGB('b7ffe9');
            $spreadsheet->getActiveSheet()->getStyle('O' . $numCell)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setRGB('ffbcc7');
            $spreadsheet->getActiveSheet()->getStyle('P' . $numCell)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setRGB('feffb5');
            $sheet->getStyle('B'. $numCell .':P' .$numCell)->getFont()->setBold(true);
            $sheet->getStyle('B'. $numCell .':D' .$numCell)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getRowDimension($numCell)->setRowHeight(20);
            $spreadsheet->getActiveSheet()->getStyle('I' . $numCell)->getNumberFormat()->setFormatCode('#,##0.000');
            $spreadsheet->getActiveSheet()->getStyle('N' . $numCell)->getNumberFormat()->setFormatCode('#,##0.000');
            $sheet->setCellValue('B' . $numCell, 'SUB-TOTAL');
            
            $arrSubTotal[] = $numCell;

            $sheet->setCellValue('D' . $numCell, '');
            $sheet->setCellValue('E' . $numCell, '=SUM(E' . ($fila + 1) . ':E' . ($numCell - 1) . ')');
            $sheet->setCellValue('F' . $numCell, '=SUM(F' . ($fila + 1) . ':F' . ($numCell - 1) . ')');
            $sheet->setCellValue('G' . $numCell, '=SUM(G' . ($fila + 1) . ':G' . ($numCell - 1) . ')');
            $sheet->setCellValue('H' . $numCell, '=SUM(H' . ($fila + 1) . ':H' . ($numCell - 1) . ')');
            $sheet->setCellValue('I' . $numCell, '=SUM(I' . ($fila + 1) . ':I' . ($numCell - 1) . ')');
            $sheet->setCellValue('J' . $numCell, '=SUM(J' . ($fila + 1) . ':J' . ($numCell - 1) . ')');
            $sheet->setCellValue('K' . $numCell, '=SUM(K' . ($fila + 1) . ':K' . ($numCell - 1) . ')');
            $sheet->setCellValue('L' . $numCell, '=SUM(L' . ($fila + 1) . ':L' . ($numCell - 1) . ')');
            $sheet->setCellValue('M' . $numCell, '=SUM(M' . ($fila + 1) . ':M' . ($numCell - 1) . ')');
            $sheet->setCellValue('N' . $numCell, '=SUM(N' . ($fila + 1) . ':N' . ($numCell - 1) . ')');
            $sheet->setCellValue('O' . $numCell, '=SUM(O' . ($fila + 1) . ':O' . ($numCell - 1) . ')');
            $sheet->setCellValue('P' . $numCell, '=SUM(P' . ($fila + 1) . ':P' . ($numCell - 1) . ')');
            
            $sheet->getStyle('B'. $numCell .':P' .$numCell)->applyFromArray($styleArray);
            // Espacio en blanco
            $space = $numCell + 1;

            if($numCell == 50)
            {
                // SALTO DE PAGINA
                $spreadsheet->getActiveSheet()->setBreak('Q' . $numCell, \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::BREAK_ROW); /* new */
            }
            $sheet->setCellValue('B' . $space, '');
            $fila = $space + 1;
        }

        $numCellTotal = $fila + 1;
        $sheet->mergeCells('B'. $numCellTotal .':D' .$numCellTotal);
        $sheet->getStyle('B'. $numCellTotal .':D' .$numCellTotal)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('B'. $numCellTotal .':D' .$numCellTotal)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E'. $numCellTotal .':P' .$numCellTotal)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('E'. $numCellTotal .':P' .$numCellTotal)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('E'. $numCellTotal .':I' .$numCellTotal)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setRGB('d7f4fe');
        $spreadsheet->getActiveSheet()->getStyle('J'. $numCellTotal .':N' .$numCellTotal)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setRGB('b7ffe9');
        $spreadsheet->getActiveSheet()->getStyle('O'. $numCellTotal)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setRGB('ffbcc7');
        $spreadsheet->getActiveSheet()->getStyle('P'. $numCellTotal)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setRGB('feffb5');
        $spreadsheet->getActiveSheet()->getRowDimension($numCellTotal)->setRowHeight(20);
        $spreadsheet->getActiveSheet()->getStyle('I' . $numCellTotal)->getNumberFormat()->setFormatCode('#,##0.000');
        $spreadsheet->getActiveSheet()->getStyle('N' . $numCellTotal)->getNumberFormat()->setFormatCode('#,##0.000');
        $sheet->getStyle('B'. $numCellTotal .':P' .$numCellTotal)->getFont()->setBold(true);
        $sheet->getStyle('B'. $numCellTotal .':P' .$numCellTotal)->applyFromArray($styleArray);

        $sheet->setCellValue('B' . $numCellTotal, 'TOTAL');
        // SUMAR TODOS LOS SUBTOTALES DESDE LA CELDA E HASTA LA P.
        $i = 'E';
        for($i; $i <= 'P'; $i++)
        {
            $cadena = '';
            foreach($arrSubTotal as $tot)
            {
                $cadena .= '+' . $i . $tot;
            }
            $sheet->setCellValue($i . $numCellTotal, '=' . $cadena);
        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="COORDINACIÓN MARÍTIMA - ' . $load->bl . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
}
