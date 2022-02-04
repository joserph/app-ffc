<?php

namespace App\Exports;

use App\MasterInvoiceItem;
use App\InvoiceHeader;
use App\LogisticCompany;
use App\Company;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportsMasterInvoice implements FromView, WithStyles
{
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:L1')->getFont()->setBold(true);
        $sheet->mergeCells('A1:L1');
        $sheet->getStyle('A1:L1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A1:L1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('A2:F2');
        $sheet->getStyle('A2:F2')->getFont()->setBold(true);
        $sheet->getStyle('A2:F2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A2:F2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('G2:L2');
        $sheet->getStyle('G2:L2')->getFont()->setBold(true);
        $sheet->getStyle('G2:L2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('G2:L2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('A11:L11')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A11:L11')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('A12:L12')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A12:L12')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('A15:L15')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A15:L15')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    }

    public function __construct(int $code)
    {
        $this->code = $code;
    }

    public function view(): View
    {
        // Cabecera de la factura
        $invoiceheaders = InvoiceHeader::orderBy('id', 'DESC')->where('id_load', '=', $this->code)->first();
        
        // Empresas de Logistica "Activa"
        $lc_active = LogisticCompany::where('active', '=', 'yes')->first();

        // Mi empresa
        $company = Company::first();

        $invoiceItemsAll = MasterInvoiceItem::select('*')
            ->where('id_load', '=', $this->code)
            ->with('variety')
            ->with('invoiceh')
            ->with('client')
            ->with('client_confirm')
            ->join('farms', 'master_invoice_items.id_farm', '=', 'farms.id')
            ->orderBy('farms.name', 'ASC')
            ->get();

        $invoiceItems = InvoiceHeader::groupEqualsMasterInvoice($invoiceItemsAll, $this->code);
        //dd($invoiceItems);

        return view('exports.masterInvoicesItemExcel', [
            'invoiceItems' => $invoiceItems,
            'invoiceheaders' => $invoiceheaders,
            'lc_active' => $lc_active,
            'company' => $company
        ]);
    }
}
