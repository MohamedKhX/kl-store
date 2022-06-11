<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use Gloudemans\Shoppingcart\Exceptions\InvalidRowIDException;
use Hamcrest\Core\IsNotTest;
use Illuminate\Support\Facades\Date;
use Livewire\Component;

class Cart extends Component
{
    public $cartItems;
    public $subTotal;
    public $newSubTotal;
    public $total;
    public $qtys = [];
    public $couponCode;
    public $isThereDiscount = false;
    public $shippingPrice = 30;
    public $discount = 0;
    public ?Coupon $coupon = null;

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
        $this->subTotal    = (string) \Gloudemans\Shoppingcart\Facades\Cart::subTotal();

        if(! is_null($this->coupon)) {
            $this->discount = $this->coupon->discount($this->subTotal);
        }

        $this->newSubTotal = $this->subTotal - $this->discount;
        $this->total       = $this->newSubTotal + $this->shippingPrice;
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
        try {
            \Gloudemans\Shoppingcart\Facades\Cart::remove($rowId);
            unset($this->qtys[$rowId]);
            $this->emit('cartCountUpdated');
        } catch (InvalidRowIDException $exception) {

        }
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

    public function increment($rowId)
    {
        if($this->qtys[$rowId] >= 5) {
           return;
        }
        $this->qtys[$rowId]  += 1;
        $this->updatedQtys();
    }


    public function decrement($rowId)
    {
        if ($this->qtys[$rowId] <= 1) {
            return;
        }
        $this->qtys[$rowId] -= 1;
        $this->updatedQtys();

    }

    public function applyCoupon()
    {
        $this->coupon = Coupon::findCoupon($this->couponCode);

        if(! $this->coupon) {
            session()->flash('couponError', __('cart.invalid_coupon'));
            return;
        }

        if(! $this->coupon->isValidToUse()) {
            return;
        }

        $this->discount = $this->coupon->discount($this->subTotal);

        session()->flash('couponSuccess', __('cart.coupon_has_been_activated'));
    }

    public function deleteCoupon()
    {
        $this->discount = 0;
        $this->coupon = null;
    }

}
