<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category_id' => Category::factory(),
            'user_id'     => User::factory(),
            'name'        => $this->faker->name(),
            'thumbnail'   => 'https://img-lcwaikiki1.mncdn.com/mnresize/640/-/Resource/Images/Banner/190522-erkek.jpg',
        ];
    }
}
