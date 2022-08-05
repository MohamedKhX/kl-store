<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderProductCard extends Component
{
    public $product;
    public Order $order;

    public string $size;
    public string $quantity;

    protected array $rules = [
      'size' => 'required',
      'quantity' => 'required|numeric'
    ];

    public function mount()
    {
        $this->size = $this->product['options']['size'];
        $this->quantity = $this->product['qty'];
    }

    public function handleUpdate()
    {
        $this->validate();
        $order = Order::find($this->order->id);

        $products = $order->products->map(function ($product) {
            if($product['rowId'] == $this->product['rowId']) {

                $product['qty']             = +$this->quantity;
                $product['subtotal']        = $product['price'] * $product['qty'];
                $product['options']['size'] = $this->size;


                $this->product['qty']             = $product['qty'];
                $this->product['subtotal']        = $product['subtotal'];
                $this->product['options']['size'] = $this->size;


                return $product;
            }
            return $product;
        })->all();

        $order->products = json_encode($products);
        $order->save();

        $this->emit('refreshOrderDetails');
        session()->flash('success', 'success');
    }

    public function render()
    {
        return view('livewire.order-product-card');
    }
}
