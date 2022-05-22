<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->paragraph(2),
            'thumbnail' => 'https://img-lcwaikiki1.mncdn.com/mnresize/640/-/Resource/Images/Banner/220222-erkekvision.jpg',
            'user_id' => User::factory()
        ];
    }
}
