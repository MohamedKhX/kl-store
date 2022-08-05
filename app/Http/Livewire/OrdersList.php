<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrdersList extends Component
{
    public $ordersName;
    public $orders = [];
    public $archived = false;

    protected $listeners = ['loadOrders'];


    public function mount()
    {
        $this->loadOrders();
    }
    public function loadOrders()
    {
        if($this->archived) {
            $this->orders = Order::getArchivedOrders()->get();
            return;
        }

        if($this->ordersName == 'All') {
            $this->orders = Order::getOrders()->get()->sortByDesc('created_at');
        } else {
            $this->orders = Order::getOrders()->where('status', '=', $this->ordersName)->get();
        }
    }

    public function render()
    {
        return view('livewire.orders-list');
    }
}
