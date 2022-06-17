<?php

namespace App\WebScrapers;

use Goutte\Client;

class KotonScraper
{
    public function colors(string $uri)
    {
        $client = new Client();
        $crawler = $client->request('GET', $uri);

        $colors = $crawler->filter('.colorVariant')->each(function($node) {
            return 'https://www.koton.com' . $node->attr('href');
        });


        $results = [];

        foreach ($colors as $color) {
            $colorInfo = new KotonColorScraper();
            $colorInfo = $colorInfo->getColor($color);
            $results[] = $colorInfo;
        }

        return $results;
    }
}
