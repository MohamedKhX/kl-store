<?php

namespace App\WebScrapers;

use Goutte\Client;

class KotonColorScraper
{
    public function getColor(string $uri)
    {
        $client = new Client();
        $crawler = $client->request('GET', $uri);


        //Start Images side

        $images = $crawler->filter('.zoomImgLink')->each(function ($node) {
           return $node->children()->attr('alt-src');
        });

        $sizes = $crawler->filter('.size-items')->each(function ($node) {
            return [
                'size'  => $node->children()->children()->text(),
                'price' => $node->children()->children()->attr('stocklevel')
            ];
        });

        $price = explode(',' ,str_replace('₺', '', $crawler->filter('.normalPrice')->text()))[0];

        return [
            'url'       => $uri,
            'thumbnail' => $images[0],
            'images'    => $images,
            'sizes'     => $sizes,
            'price'     => $price
        ];
    }
}
