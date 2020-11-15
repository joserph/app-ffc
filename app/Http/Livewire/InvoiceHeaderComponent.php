<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\InvoiceHeader;
use App\Load;
use App\LogisticCompany;
use App\Company;

class InvoiceHeaderComponent extends Component
{
    public $invoiceheader_id, $id_company, $id_load, $id_logistics_company, $bl, $carrier, $invoice, $total_bunches, $total_fulls, $total_pieces, $total_stems, $total, $id_user, $update_user, $shipment;
    public $view = 'create';
    public $code1, $prueba;
    
    public function render()
    {
        // Busco el id de la carga por medio de la URL
        $url = $_SERVER["REQUEST_URI"];
        
        $div = explode("/", $url);
        
        $code1 = $div[2];
        //dd($code1);
        

        return view('livewire.invoice-header-component', [
            'load' => Load::select('id')->find($code1),
            'logistics' => LogisticCompany::orderBy('id', 'DESC')->pluck('name', 'id'),
            'company' => Company::get()
        ]);
    }

    public function mount($prueba)
    {
        $url = $_SERVER["REQUEST_URI"];
        
        $div = explode("/", $url);
        
        $code1 = $div[2];

        $prueba = Load::select('id')->find($code1);
        $this->prueba = $prueba;
    }

    
    public function store()
    {
        dd($this->id_load);
        // Busco el id de la carga por medio de la URL
        $url = $_SERVER["REQUEST_URI"];
        
        $div = explode("/", $url);
        //dd($div);
        $code1 = $div[2];
        
        $this->id_load = Load::select('shipment')->find($code1);
        //dd($this->id_load);
        // Validaciones
        $this->validate([
            'id_company'            => 'required',
            'id_load'               => 'required',
            'id_logistics_company'  => 'required',
            'bl'                    => 'required',
            'carrier'               => '',
            'invoice'               => '',
            'total_bunches'         => '',
            'total_fulls'           => '',
            'total_pieces'          => '',
            'total_stems'           => '',
            'total'                 => '',
        ]);

        $this->carrier = InvoiceHeader::select('id')->find($this->id_company);
        

        $invoiceHeader = InvoiceHeader::create([
            'id_company'            => $this->id_company,
            'id_load'               => $this->id_load,
            'id_logistics_company'  => $this->id_logistics_company,
            'bl'                    => $this->bl,
            'carrier'               => $this->carrier,
            'invoice'               => $this->invoice,
            'total_bunches'         => $this->total_bunches,
            'total_fulls'           => $this->total_fulls,
            'total_pieces'          => $this->total_pieces,
            'total_stems'           => $this->total_stems,
            'total'                 => $this->total
        ]);
    }
}
