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
    public $invoiceheader_id, $id_company, $id_load, $bl, $carrier, $invoice, $date, $total_bunches, $total_fulls, $total_pieces, $total_stems, $total, $id_user, $update_user, $shipment;
    public $view = 'create';
    public $code1, $invoiceheader, $logi, $company;
    public $id_logistics_company;
    
    public function render()
    {
        // Busco el id de la carga por medio de la URL
        $url = $_SERVER["REQUEST_URI"];
        
        $div = explode("/", $url);
        
        $code1 = $div[2];

        // Cabecera de la factura
        //$invoiceheaders = InvoiceHeader::orderBy('id', 'DESC')->where('id_load', '=', $code1)->paginate(2);
        //dd($invoiceheaders);
        
        // Empresa de logistica que guardamos en la cabecera
        /*$invoiceHeader_lc = InvoiceHeader::select('id_logistics_company')->where('id_load', '=', $code1)->first();
        
        if(!$invoiceHeader_lc)
        {
            $invoiceHeader_lc = 1;
        }else{
            $invoiceHeader_lc = $invoiceHeader_lc->id_logistics_company;
        }
        $logistics_company = LogisticCompany::where('id', '=', $invoiceHeader_lc)->first();*/

        return view('livewire.invoice-header-component', [
            'invoiceheaders' => InvoiceHeader::orderBy('id', 'DESC')->where('id_load', '=', $code1)->paginate(2), // Posible solucion correr un array en la vista
        ]);
    }

    public function mount($id_load, $bl, $id_company, $shipment, $company, $id_logistics_company, $logi)
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

        // Empresas de Logistica 
        $lc_active = LogisticCompany::where('active', '=', 'yes')->first();
        $this->logi = $lc_active->name;
        // ID
        $this->id_logistics_company = $lc_active->id;

        // Mi empresa
        $this->company = Company::get();

        //dd($this->logi);
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

        $this->carrier = Load::select('carrier')->find($this->id_load);

        $invoiceHeader = InvoiceHeader::create([
            'id_company'            => $this->id_company,
            'id_load'               => $this->id_load,
            'id_logistics_company'  => $this->id_logistics_company,
            'bl'                    => $this->bl,
            'carrier'               => $this->carrier->carrier,
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

        $this->edit($invoiceHeader->id);
        
        session()->flash('create', 'La factura master "' . $invoiceHeader->invoice . '" se creó con éxito');
        $this->render();
    }

    public function edit($id)
    {
        $invoiceHeader = InvoiceHeader::find($id);

        $this->invoiceheader_id = $invoiceHeader->id;
        $this->id_company = $invoiceHeader->id_company;
        $this->id_load = $invoiceHeader->id_load;
        $this->id_logistics_company = $invoiceHeader->id_logistics_company;
        $this->bl = $invoiceHeader->bl;
        $this->carrier = $invoiceHeader->carrier;
        $this->invoice = $invoiceHeader->invoice;
        $this->date = $invoiceHeader->date;
        $this->total_bunches = $invoiceHeader->total_bunches;
        $this->total_fulls = $invoiceHeader->total_fulls;
        $this->total_pieces = $invoiceHeader->total_pieces;
        $this->total_stems = $invoiceHeader->total_stems;
        $this->total = $invoiceHeader->total;

        $this->view = 'edit';
    }
}
