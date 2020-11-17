<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\InvoiceHeader;
use App\Load;
use App\LogisticCompany;
use App\Company;
use Auth;

class InvoiceHeaderComponent extends Component
{
    public $invoiceheader_id, $id_company, $id_load, $id_logistics_company, $bl, $carrier, $invoice, $date, $total_bunches, $total_fulls, $total_pieces, $total_stems, $total, $id_user, $update_user, $shipment;
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
            'load' => Load::find($code1),
            'logistics' => LogisticCompany::orderBy('id', 'DESC')->pluck('name', 'id'),
            'company' => Company::get(),
            'invoiceheader' => InvoiceHeader::where('id_load', '=', $code1)->first()
        ]);
    }

    public function mount($id_load, $bl, $id_company, $shipment)
    {
        // Busco el ID de la carga por medio de la URL
        $url = $_SERVER["REQUEST_URI"];
        $div = explode("/", $url);
        $code1 = $div[2];
        $id_load = Load::find($code1);
        $this->id_load = $id_load->id;

        // BL
        $this->bl = $id_load->bl;
        
        // ID Company
        $id_company = Company::get();
        $this->id_company = $id_company[0]->id;

        // Carga
        $this->shipment = $id_load->shipment;
    }

    
    public function store()
    {
        
        // Validaciones
        $this->validate([
            'id_company'            => 'required',
            'id_load'               => 'required',
            'id_logistics_company'  => 'required',
            'bl'                    => 'required',
            'carrier'               => '',
            'invoice'               => '',
            'date'                  => 'required',
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
            'date'                  => $this->date,
            'total_bunches'         => $this->total_bunches,
            'total_fulls'           => $this->total_fulls,
            'total_pieces'          => $this->total_pieces,
            'total_stems'           => $this->total_stems,
            'total'                 => $this->total,
            'id_user'               => Auth::user()->id,
            'update_user'           => Auth::user()->id
        ]);

        //$this->edit($invoiceHeader->id);

        session()->flash('create', 'La factura master "' . $invoiceHeader->invoice . '" se creó con éxito');
    }
}
