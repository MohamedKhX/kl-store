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
    public int $toShow = 8;

    public function showProduct($id)
    {
        $this->emit('SingleProduct', $id);
    }

    public function showMore()
    {
        $this->toShow += 6;
    }

    public function render()
    {
        $allProducts   = \App\Models\Product::where('category_id', '=', $this->category->id)->get();
        $products      = $allProducts->take($this->toShow);
        $productsCount = $allProducts->count();

        return view('livewire.category-tab', [
            'products'      => $products,
            'productsCount' => $productsCount
        ]);
    }
}
