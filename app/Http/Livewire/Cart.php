<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Coupon;
use Gloudemans\Shoppingcart\Exceptions\InvalidRowIDException;
use Hamcrest\Core\IsNotTest;
use Illuminate\Support\Facades\Date;
use Livewire\Component;

class Cart extends Component
{
    public $cartItems;
    public $cities = [];
    public $selectedCityId;
    public $selectedCity;
    public $qtys   = [];

    public $subTotal;
    public $newSubTotal;
    public $total;
    public $couponCode;
    public $shippingPrice = 0;
    public $discount = 0;
    public ?Coupon $coupon = null;

    public $full_name;
    public $email_address;
    public $phone_number;
    public $address;
    public $notes;

    protected $listeners = ['newItemAddedToCart', 'updateCart', 'deleteItemFromCart'];

    protected $rules = [
        'full_name'      => 'required|min:3|max:16',
        'phone_number'   => 'required|integer|min:10|max:20',
        'email_address'  => 'nullable|email',
        'address'        => 'required',
        'selectedCityId' => ''
    ];

    public function mount()
    {
        $this->checkIfCartContentIsCorrect();
        $this->cartItems = \Gloudemans\Shoppingcart\Facades\Cart::content();
        $this->cities    = City::all();
        $this->selectedCityId = $this->cities->first();
        $this->selectedCity   = $this->cities->first();
        $this->shippingPrice  = $this->selectedCity->price;

        $this->qtys = $this->cartItems->map(function($item) {
            return $item->qty;
        });

    }

    protected function checkIfCartContentIsCorrect()
    {
        $cartItems = \Gloudemans\Shoppingcart\Facades\Cart::content();
        $products  = \App\Models\Product::all();

        $productsNotFound = \Gloudemans\Shoppingcart\Facades\Cart::search(function ($cartItem, $rowId) use($products) {
            if(! $products->count()) {
                \Gloudemans\Shoppingcart\Facades\Cart::destroy();
                return;
            }

            foreach ($products as $product) {
                if($cartItem->options['product_id'] != $product->id) {
                    continue;
                }
                foreach ($product->colors as $color) {
                    if($cartItem->id != $color->id) {
                        continue;
                    }
                    foreach ($color->sizes as $size) {
                        if($cartItem->options['size'] != $size->size) {
                            continue;
                        }
                        if($size->qty <= 0) {
                            if(\Gloudemans\Shoppingcart\Facades\Cart::get($cartItem->rowId)) {
                                \Gloudemans\Shoppingcart\Facades\Cart::remove($cartItem->rowId);
                            }
                        }
                    }

                    return;
                }


                try {
                    \Gloudemans\Shoppingcart\Facades\Cart::remove($cartItem->rowId);
                } catch (\Exception $exception) {

                }
            }


            try {
                \Gloudemans\Shoppingcart\Facades\Cart::remove($cartItem->rowId);
            } catch (\Exception $exception) {

            }

        });
    }

    public function updatedQtys()
    {
        foreach ($this->qtys as $rowId => $qty) {
            \Gloudemans\Shoppingcart\Facades\Cart::update($rowId, $qty);
        }
        $this->updateCart();
    }

    public function updatedSelectedCityId()
    {
        $city = $this->cities->find($this->selectedCityId);
        $this->shippingPrice = $city->price;
        $this->selectedCity  = $city;
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

    public function updateCart()
    {
        $this->subTotal    = (string) \Gloudemans\Shoppingcart\Facades\Cart::subTotal();

        if(! is_null($this->coupon) && $this->coupon->isValidToUse()) {
            $this->discount = $this->coupon->discount($this->subTotal);
        }

        $this->newSubTotal = $this->subTotal - $this->discount;
        $this->total       = $this->newSubTotal + $this->shippingPrice;
        $this->emit('cartCountUpdated');
        $this->emit('updateCartSummary');
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

    public function handleOrder()
    {
        $this->validate();

        $order = new \App\Models\Order();
        $order->name = $this->full_name;
        $order->email = $this->email_address;
        $order->phone_number = $this->phone_number;

        $order->city = json_encode([
            'name' => $this->selectedCity->name,
            'price' => $this->selectedCity->price
        ]);

        $order->address = $this->address;
        $order->notes = $this->notes;

        $products = $this->cartItems->toJson();
        $order->products = $products;

        if($this->discount) {
            $order->options = json_encode([
               'discount'    => $this->discount,
               'subTotal'    => $this->subTotal,
               'newSubTotal' => $this->newSubTotal
            ]);
        }

        $order->save();

        \Gloudemans\Shoppingcart\Facades\Cart::destroy();
        $this->cartItems = [];
        $this->qtys      = [];

        $this->full_name    = '';
        $this->phone_number = '';
        $this->notes        = '';
        $this->email_address = '';
        $this->address = '';
        $this->coupon = null;
        $this->couponCode = '';
        $this->discount = 0;

        session()->flash('orderCompleted', __('cart.order_completed'));
    }
}
