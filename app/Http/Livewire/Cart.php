<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public $cartItems;
    public $subTotal;
    public $total;

    protected $listeners = ['newItemAddedToCart', 'updateCart'];

    public function updateCart()
    {
        $this->subTotal = \Gloudemans\Shoppingcart\Facades\Cart::subtotal();
        $this->total    = \Gloudemans\Shoppingcart\Facades\Cart::total();
    }

    public function newItemAddedToCart()
    {
        $this->cartItems = \Gloudemans\Shoppingcart\Facades\Cart::content();
    }

    public function render()
    {
        $this->updateCart();

        $this->cartItems = \Gloudemans\Shoppingcart\Facades\Cart::content();

        return view('livewire.cart');
    }

    public function deleteItemFromCart($rowId)
    {
        \Gloudemans\Shoppingcart\Facades\Cart::remove($rowId);
    }

    public function showProduct($id)
    {
        $this->emit('SingleProduct', $id);
    }
}
