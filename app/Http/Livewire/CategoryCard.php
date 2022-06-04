<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CategoryCard extends Component
{
    public \App\Models\Category $category;

    public function showCategory(int $id)
    {
        $this->emit('showCategory', $id);
    }

    public function render()
    {
        return view('livewire.category-card');
    }
}
