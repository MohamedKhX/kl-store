<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function products(): Attribute
    {
        return Attribute::get(fn($value) => collect(json_decode($value, true)));
    }

    public function city(): Attribute
    {
        return Attribute::get(fn($value) => json_decode($value));
    }

    public function priceWithOutShipping(): int
    {
        $price = 0;
        foreach ($this->products as $product) {
            $price += (int) $product['subtotal'];
        }

        return $price;
    }

    public function priceWithShipping(): int
    {
        return $this->priceWithOutShipping() + $this->city->price;
    }

    public function totalProducts(): int
    {
        return count($this->products);
    }

    public function totalQuantity()
    {
        $quantity = 0;
        foreach ($this->products as $product) {
            $quantity += (int) $product['qty'];
        }
        return $quantity;
    }
}
