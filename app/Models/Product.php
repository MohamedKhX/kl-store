<?php

namespace App\Models;

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

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function collections()
    {
        return $this->belongsToMany(Collection::class);
    }
}
