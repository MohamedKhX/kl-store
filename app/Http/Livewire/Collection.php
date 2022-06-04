<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Collection extends Component
{
    public bool $showCollection = false;
    public int  $identifier     = 5;
    protected   $listeners      = ['showCollection', 'unShowCollection'];

    public $collection;

    public function showCollection(int $id)
    {
        $this->identifier = $id;
        $this->collection = \App\Models\Collection::all()->find($this->identifier);

        $this->showCollection = true;
    }

    public function unShowCollection()
    {
        $this->showCollection = false;
    }

    public function render()
    {
        $this->collection = \App\Models\Collection::all()->find($this->identifier);

        return view('livewire.collection');
    }
}
