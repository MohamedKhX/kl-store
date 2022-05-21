<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ProductColors;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $user = \App\Models\User::factory()->create([
             'name'  => 'Mohamed Elhadi',
             'email' => 'mohamedElhadi@gmail.com',
             'role'  => 'admin'
         ]);


         $category = Category::factory()->create([
             'user_id' => $user
         ]);

         $product1 = Product::factory()->create([
             'user_id' => $user,
             'category_id' => $category
         ]);

         ProductColors::factory(3)->create([
             'product_id' => $product1,
             'name'       => 'Shirt',
         ]);
    }
}
