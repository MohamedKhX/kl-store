<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function view()
    {
        $this->views += 1;
        $this->save();
    }

    public function scopeActive($query)
    {
        return $query->has('colors')
            ->where('status', '=', true)
            ->orderBy('priority', 'desc');
    }

    public function colors(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductColors::class);
    }

    public function price(): string
    {
        if($this->colors->first()) {
            return $this->colors()->first()->priceWithCurrency() ?? '0';
        }
        return 'No Colors Yet';
    }

    public function oldPrice()
    {
        return $this->colors()->first()->old_price ?? null;
    }

    public function thumbnail()
    {
        if(is_null($this->thumbnail)) {
            return $this->colors()->first()->images[0] ?? '';
        }

        return url('storage/' . $this->thumbnail);
    }

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function collections(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Collection::class);
    }
}
