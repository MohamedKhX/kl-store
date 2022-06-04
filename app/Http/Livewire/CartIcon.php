<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartIcon extends Component
{
    public int $count;
    protected $listeners = ['cartCountUpdated'];

    public function mount()
    {
        $this->count = \Gloudemans\Shoppingcart\Facades\Cart::count();
    }

    public function cartCountUpdated()
    {
        $this->count = \Gloudemans\Shoppingcart\Facades\Cart::count();
        $this->render();
    }
    public function render()
    {
        return view('livewire.cart-icon');
    }
}
