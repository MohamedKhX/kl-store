<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Order extends Component
{
    public $subTotal;
    public $discount;
    public $newSubTotal;
    public $total;
    public $cartItems = [];

    public function render()
    {
        return view('livewire.order');
    }
}
