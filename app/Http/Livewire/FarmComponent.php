<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Farm;
use Auth;

class FarmComponent extends Component
{
    use WithPagination;

    public $name, $phone, $address, $state, $city, $country;
    public $view = 'create';

    public function render()
    {
        return view('livewire.farm-component', [
            'farms' => Farm::orderBy('id', 'desc')->paginate(5)
        ]);
    }

    public function store()
    {
        // Validaciones
        $this->validate([
            'name'      => 'required',
            'phone'     => 'required',
            'address'   => 'required',
            'state'     => 'required',
            'city'      => 'required',
            'country'   => 'required',
        ]);

        Farm::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'state' => $this->state,
            'city' => $this->city,
            'country' => $this->country,
            'id_user' => Auth::user()->id,
            'update_user' => Auth::user()->id
        ]);
    }

    public function destroy($id)
    {
        Farm::destroy($id);
    }
}
