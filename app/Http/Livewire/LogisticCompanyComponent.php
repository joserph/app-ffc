<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\LogisticCompany;
use Auth;

class LogisticCompanyComponent extends Component
{
    public $logistic_id, $name, $ruc, $phone, $address, $state, $city, $country;
    public $view = 'create';

    public function render()
    {
        return view('livewire.logistic-company-component', [
            'logistics' => LogisticCompany::orderBy('id', 'DESC')->paginate(5)
        ]);
    }

    public function store()
    {
        // Validacines
        $this->validate([
            'name'      => 'required',
            'ruc'       => 'required',
            'phone'     => 'required|alpha_num',
            'address'   => 'required',
            'state'     => 'required',
            'city'      => 'required',
            'country'   => 'required',
        ]);

        $logistic = LogisticCompany::create([
            'name'          => $this->name,
            'ruc'           => $this->ruc,
            'phone'         => $this->phone,
            'address'       => $this->address,
            'state'         => $this->state,
            'city'          => $this->city,
            'country'       => $this->country,
            'id_user'       => Auth::user()->id,
            'update_user'   => Auth::user()->id
        ]);

        session()->flash('create', 'La empresa de logística "' . $logistic->name . '" se creo con éxito');

        //$this->edit($logistic->id);
    }


}
