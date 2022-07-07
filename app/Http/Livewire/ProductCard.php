<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProductCard extends Component
{
    public \App\Models\Product $product;
    public bool $rectangle = false;


    public function showProduct(int $id)
    {
        $this->emit('showProduct', $id);
    }

    public function render()
    {
        return view('livewire.product-card')->with([
            'product' => $this->product
        ]);
    }
}
