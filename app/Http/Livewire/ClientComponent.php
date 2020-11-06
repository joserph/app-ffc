<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Client;
use Illuminate\Support\Facades\Gate;

class ClientComponent extends Component
{
    use WithPagination;

    public $view = 'create';
    
    public function render()
    {
        return view('livewire.client-component', [
            'clients' => Client::orderBy('id', 'desc')->paginate(5)
        ]);
    }
}
