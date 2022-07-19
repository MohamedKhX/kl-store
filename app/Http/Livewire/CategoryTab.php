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

    protected $listeners = ['reRenderProductsCard'];

    public function mount()
    {
        $this->currentCategory = \App\Models\Category::all()->first();
    }

    public function showProduct(int $id, ?int $colorId)
    {
        $this->emit('showProduct', $id, $colorId);
    }

    public function showMore()
    {
        $this->toShow += 4;
    }

    public function reRenderProductsCard()
    {
        $this->render();
    }

    public function render()
    {
        $allProducts   = $this->category->products;
        $allProducts   = getProductsColors($allProducts);

        $products      = $allProducts->take($this->toShow);
        $productsCount = $allProducts->count();

        return view('livewire.category-tab', [
            'products'      => $products,
            'productsCount' => $productsCount
        ]);
    }
}
