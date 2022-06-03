<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColors extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function sizes(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value),
        );
    }

    public function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (round(((int) $value * 0.29) / 5) * 5) . ' LYD',
        );
    }

    public function images(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value),
        );
    }
}
