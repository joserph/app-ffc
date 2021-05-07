<?php

namespace App\Exports;

use App\MasterInvoiceItem;
use Maatwebsite\Excel\Concerns\FromCollection;

class MasterInvoice implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return MasterInvoiceItem::all();
    }
}
