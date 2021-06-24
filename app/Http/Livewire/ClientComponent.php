<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Client;
use Auth;
use Illuminate\Support\Facades\Gate;

class ClientComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap'; /// Importante

    public $client_id, $name, $phone, $address, $state, $city, $country, $poa;
    public $view = 'create';
    
    public function render()
    {
        return view('livewire.client-component', [
            'clients' => Client::orderBy('name', 'ASC')->paginate(5)
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
            'poa'       => 'required'
        ]);
        
        $client = Client::create([
            'name'          => $this->name,
            'phone'         => $this->phone,
            'address'       => $this->address,
            'state'         => $this->state,
            'city'          => $this->city,
            'country'       => $this->country,
            'poa'           => $this->poa,
            'id_user'       => Auth::user()->id,
            'update_user'   => Auth::user()->id
        ]);

        session()->flash('create', 'El cliente "' . $client->name . '" se creo con éxito');

        // Madamos a la vista editar
        $this->edit($client->id);
    }

    public function edit($id)
    {
        $client = Client::find($id);

        $this->client_id = $client->id;
        $this->name = $client->name;
        $this->phone = $client->phone;
        $this->address = $client->address;
        $this->state = $client->state;
        $this->city = $client->city;
        $this->country = $client->country;
        $this->poa = $client->poa;

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
            'poa'       => 'required'
        ]);

        $client = Client::find($this->client_id);

        $client->update([
            'name'          => $this->name,
            'phone'         => $this->phone,
            'address'       => $this->address,
            'state'         => $this->state,
            'city'          => $this->city,
            'country'       => $this->country,
            'poa'           => $this->poa,
            'id_user'       => $client->id_user,
            'update_user'   => Auth::user()->id
        ]);

        session()->flash('edit', 'El cliente "' . $client->name . '" se actualizó con éxito');
        // Madamos a la viste default
        $this->default();
    }

    public function default()
    {
        $this->name = '';
        $this->phone = '';
        $this->address = '';
        $this->state = '';
        $this->city = '';
        $this->country = '';
        $this->poa = '';

        $this->view = 'create';
    }

    public function destroy($id)
    {
        $client = Client::find($id);
        Client::destroy($id);
        session()->flash('delete', 'Eliminaste el cliente "' . $client->name);
    }
}
