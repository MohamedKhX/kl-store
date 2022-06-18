<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\City;
use App\Models\Collection;
use App\Models\Coupon;
use App\Models\ProductColors;
use App\Models\Product;
use App\WebScrapers\LcwikiScraper;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;

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
        $this->call(CollectionSeeder::class);
        $this->call(CitySeeder::class);
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
        $product = Product::find($productId)->first();
        $price = round(transformCurrency((int) $colorInfo['price'], $product->earnings) / 5) * 5;

        $productColor             = new ProductColors();
        $productColor->product_id = $productId;
        $productColor->thumbnail  = $colorInfo['thumbnail'];
        $productColor->price      = $price;
        $productColor->url        = $colorInfo['url'];
        $productColor->images     = json_encode($colorInfo['images']);
        $productColor->sizes      = json_encode($colorInfo['sizes']);

        $productColor->save();
    }

    public function devSeeder()
    {
        $user = \App\Models\User::factory()->create([
            'name'  => 'Mohamed Elhadi',
            'email' => 'mohamedElhadi@gmail.com',
            'password' => bcrypt('adminadmin'),
            'role'  => 'admin'
        ]);


        Coupon::factory()->create([
            'code'      => '30LYD',
            'type'      => 'fixed',
            'value'     => 30,
            'max_users' => 5,
            'expire_at' => Date::create('2030')
        ]);

        Coupon::factory()->create([
            'code'        => '50OFF',
            'type'        => 'percent_off',
            'percent_off' => 50,
            'max_users'   => 1,
            'expire_at'   => Date::create('2035')
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

        $clothes = [/*
            'https://www.lcwaikiki.com/tr-TR/TR/urun/LC-WAIKIKI/erkek/Tisort/5642651/2300495',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/LC-WAIKIKI/erkek/Gomlek/5677110/2379584',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/LC-WAIKIKI/erkek/Gomlek/5840056/2372280',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/LC-WAIKIKI/erkek/Pantolon/5889619/2385446',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/LC-WAIKIKI/erkek/Gomlek/5152739/1677974',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/LC-WAIKIKI/erkek/Gomlek/4966620/1570095',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/LC-WAIKIKI/erkek/Gomlek/4966623/1572076',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/LC-WAIKIKI/erkek/Gomlek/5387674/2381092',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/outlet/LC-WAIKIKI/erkek/Gomlek/5175428/1657014',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/LC-WAIKIKI/erkek/Gomlek/5840074/2390467',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/LC-WAIKIKI/erkek/Gomlek/4960717/1575237',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/outlet/LC-WAIKIKI/erkek/Pantolon/5103498/1680990',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/LC-WAIKIKI/erkek/Sort/5665796/2374427',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/LC-WAIKIKI/erkek/Gomlek/5840074/2376966',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/XSIDE/erkek/Gomlek/5786224/2368106',*/
            'https://www.lcwaikiki.com/tr-TR/TR/urun/LC-WAIKIKI/erkek/Gomlek/5731208/2414786',
            'https://www.lcwaikiki.com/tr-TR/TR/urun/LC-WAIKIKI/erkek/Gomlek/5708750/2328983'
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
}
