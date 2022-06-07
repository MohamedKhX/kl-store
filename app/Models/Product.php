<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function colors(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductColors::class);
    }

    public function price(): string
    {
        return $this->colors()->first()->priceWithCurrency() ?? '0';
    }

    public function oldPrice()
    {
        return $this->colors()->first()->old_price;
    }

    public function thumbnail()
    {
        if(is_null($this->thumbnail)) {
            return $this->colors()->first()->images[0] ?? '';
        }

        return url('storage/' . $this->thumbnail);
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function collections(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Collection::class);
    }
}
