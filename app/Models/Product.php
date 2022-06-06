<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function colors()
    {
        return $this->hasMany(ProductColors::class);
    }

    public function price()
    {
        return $this->colors()->first()->price ?? '0';
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

    public function collections()
    {
        return $this->belongsToMany(Collection::class);
    }
}
