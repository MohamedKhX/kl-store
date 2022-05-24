<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Collection extends Component
{
    public function render()
    {
        $collection = \App\Models\Collection::all()->where('slug', '=', 'best-sellers')->first();
        return view('livewire.collection')->with([
            'products' => $collection->products
        ]);
    }
}
