<?php

namespace Database\Seeders;

use App\Models\Collection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialCollections = ['أفضل العروض', 'أفضل المبيعات', 'لدينا حاليا'];

        foreach ($specialCollections as $collection) {
            $slugs = [
                'أفضل العروض'   => 'best-deals',
                'أفضل المبيعات' => 'best-sellers',
                'لدينا حاليا'   => 'new-arrivals',
            ];

            $collectionToCreate = Collection::factory()->create([
                'user_id'     => 1,
                'special'     => true,
                'name'        => $collection,
                'slug'        => str($slugs[$collection])->lower()->slug(),
                'description' => $collection . ' Description',
                'thumbnail'   => 'collection_thumbnails/' . 'Ex.jpg',
            ]);
        }
    }
}
