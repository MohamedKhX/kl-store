<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use Livewire\Component;

class CartSummary extends Component
{
    public $cartItems = [];
    public $newSubTotal;
    public $total;
    public $subTotal;
    public $couponCode;
    public $shippingPrice = 30;
    public $discount = 0;
    public ?Coupon $coupon = null;

    protected $listeners = ['updateCartSummary'];

    public function updateCartSummary()
    {
        $this->subTotal    = (string) \Gloudemans\Shoppingcart\Facades\Cart::subTotal();

        if(! is_null($this->coupon) && $this->coupon->isValidToUse()) {
            $this->discount = $this->coupon->discount($this->subTotal);
        }

        $this->newSubTotal = $this->subTotal - $this->discount;
        $this->total       = $this->newSubTotal + $this->shippingPrice;
        $this->emit('cartCountUpdated');
    }

    public function applyCoupon()
    {
        $this->coupon = Coupon::findCoupon($this->couponCode);

        if(! $this->coupon) {
            session()->flash('couponError', __('cart.invalid_coupon'));
            return;
        }

        if(! $this->coupon->isValidToUse()) {
            session()->flash('couponError', __('cart.invalid_coupon'));
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

    public function render()
    {
        return view('livewire.cart-summary');
    }
}
