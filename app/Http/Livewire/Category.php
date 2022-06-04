<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Category extends Component
{
    public bool $showCategory = false;
    public int  $identifier   = 1;
    protected   $listeners    = ['showCategory', 'unShowCategory', 'changeCategory'];

    public $category;

    public function changeCategory($id)
    {
        $this->identifier = $id;
        $this->category   = \App\Models\Category::find($this->identifier);
    }

    public function showCategory($id)
    {
        $this->identifier = $id;
        $this->category   =  \App\Models\Category::find($this->identifier);

        $this->showCategory = true;
    }

    public function unShowCategory()
    {
        $this->showCategory = false;
    }

    public function showProduct($id)
    {
        $this->emit('showProductFromCategory', $id);
    }

    public function render()
    {
        $this->category  =  \App\Models\Category::find($this->identifier);

        return view('livewire.category');
    }
}
