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

    protected static function boot() {
        parent::boot();

        static::creating(function ($color) {
            $url = explode('?', $color->url)[0];
            $url = explode('#', $url)[0];

            $color->hash = toBase62(crc32(substr($url, -10)));
        });
    }

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
            get: function($value) {
                $sizes = json_decode($value);

                if(! isset($sizes[0])) {
                    return $sizes;
                }

                foreach ($sizes as $size) {
                    if(! checkSizeTypeNumeric($size->size)) {
                        continue;
                    }
                    return $sizes;
                }

                usort($sizes, "cmp");

                return $sizes;
            }
        );
    }

    public function priceWithCurrency($currency = 'LYD'): string
    {
        if(ar()) {
            return __('elements.LYD') . ' ‎ ' . $this->price;
        }
        return $this->price . ' LYD';
    }

    public function priceWithOutCurrency($currency = 'LYD'): string
    {
        return $this->price;
    }

    public function oldPrice()
    {
        return $this->old_price;
    }

    public function getImages()
    {
        $images = $this->images;

        if(! $this->excludedImages) {

            return $images;
        }

        $images = array_filter(array_map(function ($img) {
            if(in_array($img, $this->excludedImages)) {
                return null;
            }

            return $img;
        }, $images));

        if(empty($images)) {
            return ['No Img'];
        }

        return $images;
    }

    public function images(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
               return json_decode($value, true);
            } ,
        );
    }

    public function excludedImages(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value, true),
        );
    }

    public function scopeWithSizes($query)
    {
        return $query->whereJsonLength('sizes', '>', 0);
    }
}
