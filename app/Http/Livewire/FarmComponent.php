<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Farm;
use Auth;
use Illuminate\Support\Facades\Gate;

class FarmComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap'; /// Importante

    public $farm_id, $name, $tradename, $phone, $address, $state, $city, $country;
    public $view = 'create';

    public function render()
    {
        Gate::authorize('haveaccess', 'farms');
        
        // Mostramos todos los registros 
        return view('livewire.farm-component', [
            'farms' => Farm::orderBy('name', 'ASC')->paginate(10)
        ]);
    }

    public function store()
    {
        // Validaciones
        $this->validate([
            'name'      => 'required',
            'tradename' => 'required',
            'phone'     => 'required',
            'address'   => 'required',
            'state'     => 'required',
            'city'      => 'required',
            'country'   => 'required',
        ]);

        $farm = Farm::create([
            'name'          => $this->name,
            'tradename'     => $this->tradename,
            'phone'         => $this->phone,
            'address'       => $this->address,
            'state'         => $this->state,
            'city'          => $this->city,
            'country'       => $this->country,
            'id_user'       => Auth::user()->id,
            'update_user'   => Auth::user()->id
        ]);
        
        session()->flash('create', 'La finca "' . $farm->name . '" se creó con éxito');

        $this->edit($farm->id);
    }

    public function edit($id)
    {
        $farm = Farm::find($id);

        $this->farm_id = $farm->id;
        $this->name = $farm->name;
        $this->tradename = $farm->tradename;
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
            'tradename' => 'required',
            'phone'     => 'required',
            'address'   => 'required',
            'state'     => 'required',
            'city'      => 'required',
            'country'   => 'required',
        ]);

        $farm = Farm::find($this->farm_id);

        $farm->update([
            'name'          => $this->name,
            'tradename'     => $this->tradename,
            'phone'         => $this->phone,
            'address'       => $this->address,
            'state'         => $this->state,
            'city'          => $this->city,
            'country'       => $this->country,
            'id_user'       => $farm->id_user,
            'update_user'   => Auth::user()->id
        ]);

        session()->flash('edit', 'La finca "' . $farm->name . '" se actualizó con éxito');
        $this->default();
    }

    public function destroy($id)
    {
        $farm = Farm::find($id);
        Farm::destroy($id);
        session()->flash('delete', 'Eliminaste la finca "' . $farm->name . '"');
    }

    public function default()
    {
        Gate::authorize('haveaccess', 'farm.index');
        $this->name = '';
        $this->tradename = '';
        $this->phone = '';
        $this->address = '';
        $this->state = '';
        $this->city = '';
        $this->country = '';

        $this->view = 'create';
    }
}
