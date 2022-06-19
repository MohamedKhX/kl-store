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
    public int $toShow = 1;

    public function mount()
    {
        $this->currentCategory = \App\Models\Category::all()->first();
    }

    public function showProduct($id)
    {
        $this->emit('SingleProduct', $id);
    }

    public function showMore()
    {
        $this->toShow += 2;
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
