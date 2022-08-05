<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function scopeGetOrders($query)
    {
        return $query->where('archived', '=', false)->orderBy('created_at', 'DESC');
    }

    public function scopeGetArchivedOrders($query)
    {
        return $query->where('archived', '=', true);
    }

    public function products(): Attribute
    {
        return Attribute::get(fn($value) => collect(json_decode($value, true)));
    }

    public function city(): Attribute
    {
        return Attribute::get(fn($value) => json_decode($value));
    }

    public function options(): Attribute
    {
        return Attribute::get(fn($value) => json_decode($value));
    }

    public function priceWithOutShipping(): int
    {
        $price = 0;
        foreach ($this->products as $product) {
            $price += (int) $product['subtotal'];
        }

        if($this->options) {
            return $this->options->newSubTotal;
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

    public function totalQuantity(): int
    {
        $quantity = 0;
        foreach ($this->products as $product) {
            $quantity += (int) $product['qty'];
        }
        return $quantity;
    }

    public function shippingPrice()
    {
        return $this->city->price;
    }
}
