<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductColors>
 */
class ProductColorsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_id'       => Product::factory(),
            'name'             => $this->faker->word(),
            'price'            => $this->faker->randomDigitNotZero() * 10,
            'color'            => 'black',
            'sizes'            => json_encode(['S', 'L', 'XL', 'XL']),
            'images'           => json_encode([
                'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20221/5677110/v2/l_20221-s2bk63z8-cvl_a.jpg',
                'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20221/5677110/v2/l_20221-s2bk63z8-cvl_a1.jpg',
                'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20221/5677110/v2/l_20221-s2bk63z8-cvl_a2.jpg',
                'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20221/5677110/v2/l_20221-s2bk63z8-cvl_a3.jpg',
                'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20221/5677110/v2/l_20221-s2bk63z8-cvl_a4.jpg'
            ])
        ];
    }
}
