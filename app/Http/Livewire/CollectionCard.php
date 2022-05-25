<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CollectionCard extends Component
{
    public \App\Models\Collection $collection;

    public function showCollection(int $id)
    {
        $this->emit('showCollection', $id);
    }

    public function render()
    {
        return view('livewire.collection-card')->with([
            'collection' => $this->collection
        ]);
    }
}
