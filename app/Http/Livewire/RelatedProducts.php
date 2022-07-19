<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RelatedProducts extends Component
{
    public $relatedProducts;
    public \App\Models\Product $product;

    public function mount()
    {
        $this->getRelatedProducts($this->product);
    }

    public function getRelatedProducts(\App\Models\Product $product)
    {
        $this->relatedProducts = [];

        $productCategories = $product->categories;

        foreach ($productCategories as $category)
        {
            $this->relatedProducts[] = $category->productsWithColors();
        }

        $this->relatedProducts = collect($this->relatedProducts);

        $duplicates = $this->relatedProducts->flatten(1)->duplicates('id');

        $this->relatedProducts = $this->relatedProducts->flatten(1)
            ->except([...array_keys($duplicates->toArray())])
            ->filter(function ($item) use ($product) {
                if($item->id !== $product->id)
                {
                    return $item;
                }
                return null;
            })
            ->take(10)
            ->chunk(2)
        ;

    }

    public function showProduct($id)
    {
        $this->emit('showProduct', $id);

        $product = \App\Models\Product::find($id);
        $this->getRelatedProducts($product);
    }

    public function render()
    {
        return view('livewire.related-products');
    }
}
