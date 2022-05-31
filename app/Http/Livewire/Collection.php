<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Collection extends Component
{
    public bool $showCollection = false;

    public int $identifier = 5;


    protected $listeners = ['showCollection', 'changeCollection'];

    public function changeCollection($id)
    {
        $this->identifier = $id;
    }

    public function showCollection(int $id)
    {
        $this->identifier = $id;
    }

    public function unShowCollection()
    {
        $this->showCollection = false;
    }

    public function render()
    {
/*        $collection = \App\Models\Collection::all()->where('slug', '=', 'best-sellers')->first();*/
        $collection = \App\Models\Collection::all()->find($this->identifier);
        $products = $collection->products;
        return view('livewire.collection')->with([
            'collection' => $collection,
            'products' => $products
        ]);
    }
}
