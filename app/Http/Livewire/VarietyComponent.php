<?php

namespace App\Http\Livewire;

use Livewire\Component;

class VarietyComponent extends Component
{
    public $view = 'create';
    
    public function render()
    {
        return view('livewire.variety-component');
    }
}
