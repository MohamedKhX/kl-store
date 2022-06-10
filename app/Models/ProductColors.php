<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class ProductColors extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function thumbnail()
    {
        if(str($this->thumbnail)->contains('thumbnails')) {
            return url('storage/' . $this->thumbnail);
        }

        return $this->thumbnail;
    }

    public function sizes(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value),
        );
    }

    public function priceWithCurrency($currency = 'LYD'): string
    {
        return $this->price . ' LYD';
    }

    public function priceWithOutCurrency($currency = 'LYD'): string
    {
        return $this->price;
    }

    public function images(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value),
        );
    }
}
