<?php

namespace App\Http\Livewire;

use App\Models\Collection;
use Livewire\Component;

class SpecialCollection extends Component
{
    public Collection $collection;
    public $products = [];
    public int   $toShow   = 4;
    public int   $showMore = 4;
    public int   $productsCount;

    public function showMore()
    {
        $this->toShow += $this->showMore;
    }

    public function showProduct(int $id)
    {
        $this->emit('showProduct', $id);
    }

    public function render()
    {
        $products = $this->collection->products;

        $this->productsCount = $products->count();
        $this->products      = $products->take($this->toShow);

        return view('livewire.special-collection');
    }
}
