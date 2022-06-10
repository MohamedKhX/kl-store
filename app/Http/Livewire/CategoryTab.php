<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class CategoryTab extends Component
{
    public    \App\Models\Category $category;
    public    \App\Models\Category $currentCategory;
    protected $paginationTheme = 'bootstrap';

    public function showProduct($id)
    {
        /*$this->emit('SingleProduct', $id);*/
    }

    public function render()
    {
        $products = \App\Models\Product::where('category_id', '=', $this->category->id)->paginate(4);
        return view('livewire.category-tab', [
            'products' => $products
        ]);
    }
}
