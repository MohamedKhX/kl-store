<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(Product::class)->active();
    }

    public function productsWithColors(): \Illuminate\Support\Collection
    {
        $products = [];
        foreach ($this->products as $product) {
            if($product->colorsWithSizes()->count()) {
                $products[] = $product;
            }
        }

        return collect($products);
    }

    public function scopeActive($query)
    {
        return $query->where('status', '=', true)
            ->orderBy('priority', 'desc');
    }
}
