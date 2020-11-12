<?php

namespace App\Http\Livewire;

use Livewire\Component;

class InvoiceHeaderComponent extends Component
{
    public $view = 'create';
    
    public function render()
    {
        return view('livewire.invoice-header-component');
    }
}
