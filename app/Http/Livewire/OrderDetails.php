<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderDetails extends Component
{
    public Order $order;

    protected $listeners = ['refreshOrderDetails'];

    public function refreshOrderDetails()
    {
        $this->render();
    }

    public function render()
    {
        return view('livewire.order-details');
    }
}
