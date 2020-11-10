<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\LogisticCompany;

class LogisticCompanyComponent extends Component
{
    public $view = 'create';

    public function render()
    {
        return view('livewire.logistic-company-component', [
            'logistics' => LogisticCompany::orderBy('id', 'DESC')->paginate(5)
        ]);
    }


}
