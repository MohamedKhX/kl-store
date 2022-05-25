<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CollectionModel extends Component
{
    public function unShowCollection()
    {
        $this->emit('unShowCollection');
    }

    public function render()
    {
        return view('livewire.collection-model');
    }
}
