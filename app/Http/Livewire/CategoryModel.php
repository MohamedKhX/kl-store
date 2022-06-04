<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CategoryModel extends Component
{
    public function unShowCategory()
    {
        $this->emit('unShowCategory');
    }

    public function render()
    {
        return view('livewire.category-model');
    }
}
