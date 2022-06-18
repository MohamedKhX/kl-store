<?php

namespace App\WebScrapers;

use Goutte\Client;
use Illuminate\Support\Str;

class TrendyolColorScraper
{
    public function getColor(string $uri)
    {
        $client = new Client();
        $crawler = $client->request('GET', $uri);


        //Start Images side
        $startFromImagesToExplode = explode('"images":[', $crawler->html())[1];

        $imagesInOneArray = explode(']', $startFromImagesToExplode)[0];

        $arrayOfImages = explode(',', $imagesInOneArray);

        $images = array_map(function($item) {
            $item = str_replace('"', '', $item);
            return 'https://cdn.dsmcdn.com/' . $item;
        }, $arrayOfImages);
        // End Images Side


        //Start Sizes Side

        $startFromVariantsToExplode = explode('"allVariants":[', $crawler->html())[1];

        $variantsInOneArray = explode(']', $startFromVariantsToExplode)[0];

        $arrayOfVariants = explode('},', $variantsInOneArray);


        $sizes = [];

        foreach ($arrayOfVariants as $variant) {
            $sizes[] = explode(',', $variant);
        }

        $price = null;

        $sizes = array_map(function($item) {
            $newArray = [];

            foreach ($item as $string) {
                if(str_contains($string, 'value')
                    || str_contains($string, 'inStock')
                    || str_contains($string, 'price'))
                {
                    $newArray[] = $string;
                }
            }

            $newArray = array_map(function($item) {
                $item = str_replace('"', '', explode(':', $item)[1]);
                return $item;
            }, $newArray);


            return [
                'size' => $newArray[0],
                'qty'  => $newArray[1] == 'true' ? 10 : 0,
                'price' => $newArray[2]
            ];
        }, $sizes);

        $price = $sizes[0]['price'];

        return [
          'url'       => $uri,
          'thumbnail' => $images[0],
          'images'    => $images,
          'sizes'     => $sizes,
          'price'     => $price
        ];
    }
}
