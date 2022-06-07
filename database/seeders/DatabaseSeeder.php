<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Collection;
use App\Models\ProductColors;
use App\Models\Product;
use App\WebScrapers\LcwikiScraper;
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
            'password' => bcrypt('adminadmin'),
            'role'  => 'admin'
        ]);


        $categoryClothes = Category::factory()->create([
            'user_id'   => $user,
            'name'      => 'Clothes',
            'thumbnail' => 'category_thumbnails/' . 'clothes.jpg',
            'slug'      => 'clothes'
        ]);
        $categoryPants   = Category::factory()->create([
            'user_id'   => $user,
            'name'      => 'Pants',
            'thumbnail' => 'category_thumbnails/' . 'pants.jpg',
            'slug'      => 'pants'
        ]);
        $categoryShoes   = Category::factory()->create([
            'user_id'   => $user,
            'name'      => 'Shoes',
            'thumbnail' => 'category_thumbnails/' . 'shoes.jpg',
            'slug'      => 'shoes'
        ]);

        $collectionSeasons = ['winter', 'summer', 'spring', 'autumn'];

        foreach ($collectionSeasons as $key => $season) {
            Collection::factory()->create([
                'user_id'     => $user,
                'name'        => $season,
                'title'       => $season . ' season is amazing',
                'slug'        => $season,
                'description' => $season . 'is very great! you are not sure about that!',
                'thumbnail'   => 'collection_thumbnails/' . $key . '.jpg'
            ]);
        }


        Collection::factory()->create([
            'user_id'     => $user,
            'special'     => true,
            'name'        => 'Exclusive Collection',
            'title'       => 'Exclusive Collection',
            'slug'        => str('Exclusive')->lower()->slug(),
            'description' => 'Exclusive',
            'thumbnail'   => 'collection_thumbnails/' . 'Ex.jpg',
        ]);
        $specialCollections = ['Best deals', 'Best Sellers', 'New Arrivals'];

        foreach ($specialCollections as $collection) {
            $collectionToCreate = Collection::factory()->create([
                'user_id'     => $user,
                'special'     => true,
                'name'        => $collection,
                'title'       => $collection . 'test',
                'slug'        => str($collection)->lower()->slug(),
                'description' => $collection . 'is very great! you are not sure about that!',
                'thumbnail'   => 'collection_thumbnails/' . 'Ex.jpg',
            ]);

            $collectionToCreate->products()->attach([rand(1, 15), rand(1, 15), rand(1, 15), rand(1, 15), rand(1, 15)]);
        }

        $clothes = [
            'https://www.lcwaikiki.com/tr-TR/TR/urun/LC-WAIKIKI/erkek/Tisort/5642651/2300495',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/LC-WAIKIKI/erkek/Gomlek/5677110/2379584',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/LC-WAIKIKI/erkek/Gomlek/5840056/2372280',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/LC-WAIKIKI/erkek/Pantolon/5889619/2385446',
       /*     'https://www.lcwaikiki.com/tr-TR/TR/urun/LC-WAIKIKI/erkek/Gomlek/5152739/1677974',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/LC-WAIKIKI/erkek/Gomlek/4966620/1570095',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/LC-WAIKIKI/erkek/Gomlek/4966623/1572076',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/LC-WAIKIKI/erkek/Gomlek/5387674/2381092',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/outlet/LC-WAIKIKI/erkek/Gomlek/5175428/1657014',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/LC-WAIKIKI/erkek/Gomlek/5840074/2390467',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/LC-WAIKIKI/erkek/Gomlek/4960717/1575237',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/outlet/LC-WAIKIKI/erkek/Pantolon/5103498/1680990',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/LC-WAIKIKI/erkek/Sort/5665796/2374427',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/LC-WAIKIKI/erkek/Gomlek/5840074/2376966',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/XSIDE/erkek/Gomlek/5786224/2368106',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/LC-WAIKIKI/erkek/Gomlek/5731208/2414786',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/LC-WAIKIKI/erkek/Gomlek/5708750/2328983'*/
        ];

        foreach ($clothes as $clothe) {
            $product = new Product();
            $product->websiteScraper = 'LC';
            $product->url            = $clothe;
            $product->user_id        = $user->id;
            $product->category_id    = $categoryClothes->id;
            $product->name           = 'TShirt';
            $product->description    = 'lorem ispum';
            $product->save();

            $this->scrapColors(
                productId: $product->id,
                uri: $product->url
            );
        }

    }

    public function scrapColors($productId, $uri)
    {
        $scraper = new LcwikiScraper();
        $colors = $scraper->colors($uri);

        foreach ($colors as $color) {
            $this->createProductColor($color, $productId);
        }
    }

    public function createProductColor(array $colorInfo, $productId)
    {
        //Take the price from the website convert it to LYD
        //Then round it
        $price = round(transformCurrency((int) $colorInfo['price']) / 5) * 5;

        $productColor             = new ProductColors();
        $productColor->product_id = $productId;
        $productColor->thumbnail  = $colorInfo['thumbnail'];
        $productColor->price      = $price;
        $productColor->url        = $colorInfo['url'];
        $productColor->images     = json_encode($colorInfo['images']);
        $productColor->sizes      = json_encode($colorInfo['sizes']);

        $productColor->save();
    }

    public function old() {
        $user = \App\Models\User::factory()->create([
            'name'  => 'Mohamed Elhadi',
            'email' => 'mohamedElhadi@gmail.com',
            'password' => bcrypt('adminadmin'),
            'role'  => 'admin'
        ]);


        $categoryClothes = Category::factory()->create([
            'user_id'   => $user,
            'name'      => 'Clothes',
            'thumbnail' => 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?crop=entropy&cs=tinysrgb&fm=jpg&ixlib=rb-1.2.1&q=80&raw_url=true&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170',
            'slug'      => 'clothes'
        ]);
        $categoryPants = Category::factory()->create([
            'user_id'   => $user,
            'name'      => 'Pants',
            'thumbnail' => 'https://images.unsplash.com/photo-1542272604-787c3835535d?crop=entropy&cs=tinysrgb&fm=jpg&ixlib=rb-1.2.1&q=60&raw_url=true&ixid=MnwxMjA3fDB8MHxzZWFyY2h8NXx8cGFudHN8ZW58MHx8MHx8&auto=format&fit=crop&w=500',
            'slug'      => 'pants'
        ]);


        $categoryShoes = Category::factory()->create([
            'user_id'   => $user,
            'name'      => 'Shoes',
            'thumbnail' => 'https://images.unsplash.com/photo-1460353581641-37baddab0fa2?crop=entropy&cs=tinysrgb&fm=jpg&ixlib=rb-1.2.1&q=60&raw_url=true&ixid=MnwxMjA3fDB8MHxzZWFyY2h8OHx8c2hvZXN8ZW58MHx8MHx8&auto=format&fit=crop&w=500',
            'slug'      => 'shoes'
        ]);

        $collectionSeasons = ['winter', 'summer', 'spring', 'autumn'];

        foreach ($collectionSeasons as $season) {
            Collection::factory()->create([
                'user_id'     => $user,
                'name'        => $season,
                'title'       => $season . ' season is amazing',
                'slug'        => $season,
                'description' => $season . 'is very great! you are not sure about that!',
                'thumbnail'   => 'https://images.unsplash.com/photo-1588822149715-8394a8d709f0?crop=entropy&cs=tinysrgb&fm=jpg&ixlib=rb-1.2.1&q=60&raw_url=true&ixid=MnwxMjA3fDB8MHxzZWFyY2h8N3x8c2Vhc29ufGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=500'
            ]);
        }


        $collectionIndex = ['Best deals', 'Best Sellers', 'New Arrivals'];

        foreach ($collectionIndex as $collection) {
            Collection::factory()->create([
                'user_id'     => $user,
                'special'     => true,
                'name'        => $collection,
                'title'       => $collection . 'test',
                'slug'        => str($collection)->lower()->slug(),
                'description' => $collection . 'is very great! you are not sure about that!',
                'thumbnail'   => 'https://images.unsplash.com/photo-1588822149715-8394a8d709f0?crop=entropy&cs=tinysrgb&fm=jpg&ixlib=rb-1.2.1&q=60&raw_url=true&ixid=MnwxMjA3fDB8MHxzZWFyY2h8N3x8c2Vhc29ufGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=500'
            ]);
        }


        Collection::factory()->create([
            'user_id'     => $user,
            'name'        => 'Exclusive Collection',
            'title'       => 'Exclusive Collection',
            'slug'        => str('Exclusive')->lower()->slug(),
            'description' => 'Exclusive',
            'thumbnail'   => 'https://images.unsplash.com/photo-1588822149715-8394a8d709f0?crop=entropy&cs=tinysrgb&fm=jpg&ixlib=rb-1.2.1&q=60&raw_url=true&ixid=MnwxMjA3fDB8MHxzZWFyY2h8N3x8c2Vhc29ufGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=500'
        ]);


        $productShirt = Product::factory()->create([
            'user_id'     => $user,
            'category_id' => $categoryClothes,
            'name'        => 'Shirt',
            'thumbnail'   => 'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20211/5432595/l_20211-s1ls95z8-kck_a.jpg'
        ]);

        $shirtColors = ['white', 'red', 'blue', 'cyan'];

        foreach ($shirtColors as $color) {
            $colorProduct = ProductColors::factory()->create([
                'product_id' => $productShirt,
                'name'       => $color . 'Shirt',
                'price'      => '180',
                'color'      => $color,
                'images'     => json_encode([
                    'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20211/5432595/l_20211-s1ls95z8-kck_a.jpg',
                    'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20211/5432595/l_20211-s1ls95z8-kck_a1.jpg',
                    'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20211/5432595/l_20211-s1ls95z8-kck_a2.jpg',
                    'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20211/5432595/l_20211-s1ls95z8-kck_a3.jpg',
                    'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20211/5432595/l_20211-s1ls95z8-kck_a4.jpg',
                    'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20211/5432595/v1/l_20211-s1ls95z8-kck_u.jpg',
                    'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20211/5432595/v1/l_20211-s1ls95z8-kck_u1.jpg'
                ])
            ]);
        }


        $productJacket = Product::factory()->create([
            'user_id'     => $user,
            'category_id' => $categoryClothes,
            'name'        => 'Jacket',
            'thumbnail'   => 'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20221/5549613/l_20221-s25084z8-h45_5.jpg'
        ]);

        $shirtColors = ['blue'];

        foreach ($shirtColors as $color) {
            $colorProduct = ProductColors::factory()->create([
                'product_id' => $productJacket,
                'name'       => $color . 'Jacket',
                'price'      => '280',
                'color'      => $color,
                'images'     => json_encode([
                    'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20221/5549613/l_20221-s25084z8-h45_5.jpg',
                    'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20221/5549613/l_20221-s25084z8-h45_a.jpg',
                    'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20221/5549613/l_20221-s25084z8-h45_a1.jpg',
                    'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20221/5549613/l_20221-s25084z8-h45_a2.jpg',
                    'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20221/5549613/l_20221-s25084z8-h45_a3.jpg',
                    'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20221/5549613/l_20221-s25084z8-h45_a4.jpg',
                    'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20221/5549613/l_20221-s25084z8-h45_u.jpg'
                ])
            ]);
        }

        $productSweatShirt = Product::factory()->create([
            'user_id'     => $user,
            'category_id' => $categoryClothes,
            'name'        => 'Sweat Shirt',
            'thumbnail'   => 'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20221/5531652/l_20221-s24163z1-jc7_a.jpg'
        ]);

        $shirtColors = ['blue', 'gray', 'yellow'];

        foreach ($shirtColors as $color) {
            $colorProduct = ProductColors::factory()->create([
                'product_id' => $productSweatShirt,
                'name'       => $color . 'Jacket',
                'price'      => '80',
                'color'      => $color,
                'images'     => json_encode([
                    'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20221/5531652/l_20221-s24163z1-jc7_a.jpg',
                    'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20221/5531652/l_20221-s24163z1-jc7_a1.jpg',
                    'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20221/5531652/l_20221-s24163z1-jc7_a2.jpg',
                ])
            ]);
        }


        $productSweater = Product::factory()->create([
            'user_id'     => $user,
            'category_id' => $categoryClothes,
            'name'        => 'Sweater',
            'thumbnail'   => 'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20211/4944599/l_20211-s1ct83z8-j2y_a.jpg'
        ]);

        $shirtColors = ['black', 'gray', 'bej'];

        foreach ($shirtColors as $color) {
            $colorProduct = ProductColors::factory()->create([
                'product_id' => $productSweater,
                'name'       => $color . 'Jacket',
                'price'      => '80',
                'color'      => $color,
                'images'     => json_encode([
                    'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20211/4944599/l_20211-s1ct83z8-j2y_a.jpg',
                    'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20211/4944599/l_20211-s1ct83z8-j2y_a1.jpg',
                    'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20211/4944599/l_20211-s1ct83z8-j2y_a2.jpg',
                    'https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20211/4944599/l_20211-s1ct83z8-j2y_a3.jpg',
                ])
            ]);
        }


        //take 4 products from database and put them in these collections
        $products = Product::all()->take(4)->toArray();
        $collections = array_map(fn($item) => str($item)->lower()->slug(), $collectionIndex);
        $collections = array_map(function ($item) {
            return Collection::all()->where('slug', '=', $item);
        }, $collections);

        foreach ($products as $key => $product) {
            foreach ($collections as $collection) {
                $collection->first()->products()->attach($product['id']);
            }

            //  $collections[$key]->first()->products()->attach($product['id']);
        }
    }
}
