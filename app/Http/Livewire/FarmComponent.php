<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Farm;

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
        ]);
    }

    public function destroy($id)
    {
        Farm::destroy($id);
    }
}
