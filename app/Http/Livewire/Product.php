<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Product extends Component
{

    public string $currentColor;

    public string $size;

    public int $quantity;


    public function render($id)
    {
        echo $id;
        return view('livewire.product')->with(['name' => 'Mohamed']);
    }
}
