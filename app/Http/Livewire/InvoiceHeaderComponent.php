<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\InvoiceHeader;
use App\Load;
use App\LogisticCompany;
use App\Company;

class InvoiceHeaderComponent extends Component
{
    public $view = 'create';
    

    public function render()
    {
        // Busco el id de la carga por medio de la URL
        $url = $_SERVER["REQUEST_URI"];
        $div = explode("masterinvoices/", $url);
        $code = $div[1];
        

        return view('livewire.invoice-header-component', [
            'load' => Load::find($code),
            'logistics' => LogisticCompany::orderBy('id', 'DESC')->get(),
            'company' => Company::get()
        ]);

        
    }
}
