<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Farm;

class FarmComponent extends Component
{
    use WithPagination;

    public $view = 'create';

    public function render()
    {
        return view('livewire.farm-component', [
            'farms' => Farm::orderBy('id', 'desc')->paginate(5)
        ]);
    }

    public function destroy($id)
    {
        Farm::destroy($id);
    }
}
