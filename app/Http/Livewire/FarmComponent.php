<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Farm;
use Auth;

class FarmComponent extends Component
{
    use WithPagination;

    public $farm_id, $name, $phone, $address, $state, $city, $country;
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

        $farm = Farm::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'state' => $this->state,
            'city' => $this->city,
            'country' => $this->country,
            'id_user' => Auth::user()->id,
            'update_user' => Auth::user()->id
        ]);

        $this->edit($farm->id);
    }

    public function edit($id)
    {
        $farm = Farm::find($id);

        $this->farm_id = $farm->id;
        $this->name = $farm->name;
        $this->phone = $farm->phone;
        $this->address = $farm->address;
        $this->state = $farm->state;
        $this->city = $farm->city;
        $this->country = $farm->country;

        $this->view = 'edit';
    }

    public function update()
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

        $farm = Farm::find($this->farm_id);

        $farm->update([
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'state' => $this->state,
            'city' => $this->city,
            'country' => $this->country,
            'id_user' => $farm->id_user,
            'update_user' => Auth::user()->id
        ]);

        $this->default();
    }

    public function destroy($id)
    {
        Farm::destroy($id);
    }

    public function default()
    {
        $this->name = '';
        $this->phone = '';
        $this->address = '';
        $this->state = '';
        $this->city = '';
        $this->country = '';

        $this->view = 'create';
    }
}
