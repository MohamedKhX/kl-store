<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class)->active();
    }

    public function scopeActive($query)
    {
        return $query->where('status', '=', true)
            ->orderBy('priority', 'desc');
    }

    public function background(): Attribute
    {
       return Attribute::get(function($value) {
           if($value) {
                return url('/storage/' . $value);
           }

           return null;
       });
    }

    public function scopeNotSpecial($query)
    {
        return $query->where('special', '=', false)
            ->where('status', '=', true)
            ->orderBy('priority', 'desc');
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
}
