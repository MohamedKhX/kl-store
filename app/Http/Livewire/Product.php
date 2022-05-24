<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Product extends Component
{

    public bool $showProduct = false;

    public string $identifier;

    public int $colorId;

    public int $selectedSize = 3;

    protected $listeners = ['SingleProduct', 'unShowProduct'];

    public function selectSize($key)
    {
        $this->selectedSize = $key;
    }

    public function reRender($colorId)
    {
        $this->colorId = $colorId;
    }

    public function unShowProduct()
    {
        $this->showProduct = false;
    }

    public function SingleProduct(int $id)
    {
        $this->colorId = 1;
        $this->identifier = $id;

        $this->showProduct = true;
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
