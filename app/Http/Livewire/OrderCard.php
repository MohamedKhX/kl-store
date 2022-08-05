<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderCard extends Component
{
    public Order $order;
    public $status;

    public function mount()
    {
        $this->status = $this->order->status;
    }

    public function handleSubmit()
    {
        $this->order->status = $this->status;
        $this->order->save();

        $this->emit('loadOrders');
        session()->flash('success', "Status Changed successfully <strong>($this->status)</strong>");
    }

    public function archive()
    {
        $this->order->archived = true;
        $this->order->save();

        $this->emit('loadOrders');

        session()->flash('success', "<strong>Archived successfully</strong>");

    }

    public function unArchive()
    {
        $this->order->archived = false;
        $this->order->save();

        $this->emit('loadOrders');

        session()->flash('success', "<strong>UnArchived successfully</strong>");
    }

    public function render()
    {
        return view('livewire.order-card');
    }
}
