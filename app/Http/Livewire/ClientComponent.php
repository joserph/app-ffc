<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Client;
use App\User;
use Auth;
use Illuminate\Support\Facades\Gate;
use App\Color;

class ClientComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap'; /// Importante

    public $client_id, $name, $phone, $address, $state, $city, $country, $poa, $email;
    public $view = 'create';
    public $term;
    
    public function render()
    {
        Gate::authorize('haveaccess', 'clients');

        return view('livewire.client-component', [
            'clients' => Client::when($this->term, function($query, $term){
                return $query->where('name', 'LIKE', "%$term%")
                ->orWhere('address', 'LIKE', "%$term%")
                ->orWhere('state', 'LIKE', "%$term%")
                ->orWhere('city', 'LIKE', "%$term%")
                ->orWhere('email', 'LIKE', "%$term%")
                ->orWhere('phone', 'LIKE', "%$term%")
                ->orWhere('country', 'LIKE', "%$term%");
            })->orderBy('name', 'ASC')->with('user')->paginate(10),
            'colors'    => Color::where('type', '=', 'client')->get(),
            'users' => User::orderBy('name', 'ASC')->get()
        ]);
    }

    public function store()
    {
        // Validaciones
        $this->validate([
            'name'      => 'required',
            'phone'     => '',
            'address'   => 'required',
            'state'     => 'required',
            'city'      => 'required',
            'country'   => 'required',
            'poa'       => 'required',
            'email'     => 'email'
        ]);
        
        $client = Client::create([
            'name'          => $this->name,
            'phone'         => $this->phone,
            'address'       => $this->address,
            'state'         => $this->state,
            'city'          => $this->city,
            'country'       => $this->country,
            'poa'           => $this->poa,
            'email'         => $this->email,
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
        $this->email = $client->email;

        $this->view = 'edit';
    }

    public function update()
    {
        // Validaciones
        $this->validate([
            'name'      => 'required',
            'phone'     => '',
            'address'   => 'required',
            'state'     => 'required',
            'city'      => 'required',
            'country'   => 'required',
            'poa'       => 'required',
            'email'     => 'email'
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
            'email'         => $this->email,
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
        $this->email = '';

        $this->view = 'create';
    }

    public function destroy($id)
    {
        $client = Client::find($id);
        Client::destroy($id);
        session()->flash('delete', 'Eliminaste el cliente "' . $client->name);
    }
}
