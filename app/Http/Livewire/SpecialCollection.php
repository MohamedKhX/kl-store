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
    public bool  $showCollectionName = true;
    public bool  $showByColors = false;

    protected $listeners = ['reRenderProductsCard'];

    public function reRenderProductsCard()
    {
        $this->render();
    }

    public function showMore()
    {
        $this->toShow += $this->showMore;
    }

    public function showProduct(int $id, ?int $colorId = null)
    {
        $this->emit('showProduct', $id, $colorId);
    }

    public function render()
    {
        $products = $this->collection->productsWithColors();

        if($this->showByColors) {
            $products = getProductsColors($products);
        }

        $this->productsCount = $products->count();
        $this->products      = $products->take($this->toShow);

        return view('livewire.special-collection');
    }
}
