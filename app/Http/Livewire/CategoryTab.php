<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class CategoryTab extends Component
{
    use WithPagination;

    public     \App\Models\Category $category;
    public     \App\Models\Category $currentCategory;
    protected  $paginationTheme = 'bootstrap';
    public int $toShow = 4;

    public function mount()
    {
        $this->currentCategory = \App\Models\Category::all()->first();
    }

    public function showProduct(int $id)
    {
        $this->emit('showProduct', $id);
    }

    public function showMore()
    {
        $this->toShow += 4;
    }

    public function render()
    {
        $allProducts   = $this->category->products;
        $products      = $allProducts->take($this->toShow);
        $productsCount = $allProducts->count();

        return view('livewire.category-tab', [
            'products'      => $products,
            'productsCount' => $productsCount
        ]);
    }
}
