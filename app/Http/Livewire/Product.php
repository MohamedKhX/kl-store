<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Product extends Component
{

    public string $identifier;

    public int $colorId;

    public int $selectedSize = 3;

    public function selectSize($key)
    {
        $this->selectedSize = $key;
    }

    public function reRender($colorId)
    {
        $this->colorId = $colorId;
    }

    public function render($id = null)
    {
        if(!isset($this->product)) {
           $product = \App\Models\Product::all()->find($this->identifier);
        }

        if(isset($product->colors[+$this->colorId - 1])) {
            $color  = $product->colors[+$this->colorId - 1];
        } else {
            abort(404);
        }

        return view('livewire.product')->with([
            'product' => $product,
            'color'   => $color,
        ]);
    }
}
