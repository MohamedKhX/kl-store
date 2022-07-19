<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrdersList extends Component
{
    public $ordersName;
    public $orders = [];

    protected $listeners = ['loadOrders'];

    public function loadOrders()
    {
        if($this->ordersName == 'All') {
            $this->orders = Order::all();
        } else {
            $this->orders = Order::where('status', '=', $this->ordersName)->get();
        }
    }

    public function render()
    {
        $this->loadOrders();
        return view('livewire.orders-list');
    }
}
