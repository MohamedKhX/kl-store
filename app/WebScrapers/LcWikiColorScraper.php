<?php

namespace App\WebScrapers;

use Goutte\Client;

class LcWikiColorScraper
{
    public function getColor($uri, $thumbnail): array
    {


        $client = new Client();
        $crawler = $client->request('GET', $uri);

        //Scrap color images
        $images = $crawler->filter('.product-large-image')->each(function ($node)  {
            return $node->attr('data-src');
        });

        $images = array_values(array_filter($images, fn($item) => isset($item)));


        //Scrap Sizes, Quantity

        $sizes = $crawler->filter('script')
            ->each(function ($node) {
                $newArr = [];

                if($node->attr('type') === 'text/javascript') {
                    if(str_contains($node->text(), 'var products')) {
                        $text = strchr($node->text(), 'var products');
                        $textToRemove = strchr($text, ']');
                        $text = strchr($text, 'n');

                        $text = str_replace($textToRemove, '', $text);

                        $arr = explode('new SingleSizeProduct(', $text);

                        foreach ($arr as $item) {
                            $exploded = explode(',', $item);
                            if(!isset($exploded[3])) continue;
                            $newArr[str_replace("'", '', trim($exploded[3]))] = trim($exploded[5]);
                        }
                        return $newArr;
                    }
                }

                return null;
            });

        $sizes = array_merge(array_filter($sizes, function ($arr) {
            return isset($arr);
        }))[0];

        //Scrap Price price-regular
/*        dd($crawler->filter('.price')->count());*/
        if($crawler->filter('.price')->count() >= 1) {
            $price = $crawler->filter('.price')->text();
        } else {
            $price = $crawler->filter('.price-regular')->text();
        }

        $price = explode(' ', $price)[0];

        return [
            'url'       => $uri,
            'thumbnail' => $thumbnail,
            'images'    => $images,
            'sizes'     => $sizes,
            'price'     => $price
        ];
    }
}
