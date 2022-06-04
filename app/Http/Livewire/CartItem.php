<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartItem extends Component
{
    public int    $qty  = 1;
    public string $type = 'table';
    public string $rowId;

    public function updatedQty()
    {

       \Gloudemans\Shoppingcart\Facades\Cart::update($this->rowId, $this->qty);
       $this->emit('updateCart');
    }

    public function deleteItemFromCart($rowId)
    {
        $this->emit('deleteItemFromCart', $rowId);
    }

    public function render()
    {
        $item       = \Gloudemans\Shoppingcart\Facades\Cart::get($this->rowId);
        $this->qty  = $item->qty;

        return view('livewire.cart-item')->with([
            'item' => $item
        ]);
    }
}
