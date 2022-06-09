<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \Gloudemans\Shoppingcart\Facades\Cart;
class SingleProductModel extends Component
{
    public ?int $identifier = null;
    public string $fromWhereItOpened = 'model';

    public function unShowProduct()
    {
        $this->emit('unShowProduct');
    }

    public function render()
    {
        return view('livewire.single-product-model');
    }
}
