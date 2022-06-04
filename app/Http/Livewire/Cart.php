<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public $cartItems;
    public $subTotal;
    public $total;
    public $qtys = [];

    protected $listeners = ['newItemAddedToCart', 'updateCart', 'deleteItemFromCart'];

    public function updatedQtys()
    {
        foreach ($this->qtys as $rowId => $qty) {
            \Gloudemans\Shoppingcart\Facades\Cart::update($rowId, $qty);
        }
        $this->updateCart();
    }

    public function updateCart()
    {
        $this->subTotal = \Gloudemans\Shoppingcart\Facades\Cart::subtotal();
        $this->total    = \Gloudemans\Shoppingcart\Facades\Cart::total();
        $this->emit('cartCountUpdated');
    }

    public function newItemAddedToCart()
    {
        $this->cartItems = \Gloudemans\Shoppingcart\Facades\Cart::content();
        $this->qtys = $this->cartItems->map(function($item) {
            return $item->qty;
        });
        $this->emit('cartCountUpdated');

    }

    public function deleteItemFromCart($rowId)
    {
        \Gloudemans\Shoppingcart\Facades\Cart::remove($rowId);
        unset($this->qtys[$rowId]);
        $this->emit('cartCountUpdated');
    }

    public function mount()
    {
        $this->cartItems = \Gloudemans\Shoppingcart\Facades\Cart::content();

        $this->qtys = $this->cartItems->map(function($item) {
            return $item->qty;
        });
    }


    public function render()
    {
        $this->updateCart();
        $this->cartItems = \Gloudemans\Shoppingcart\Facades\Cart::content();

        return view('livewire.cart');
    }

    public function showProduct($id)
    {
        $this->emit('SingleProduct', $id);
    }
}
