<?php

namespace App\WebScrapers;

use Goutte\Client;

class KotonScraper
{
    public function colors(?string $uri = null, ?array $colorsUrls = null): array
    {
        if(is_null($colorsUrls))
        {
            $colors = $this->getColorsUrls($uri);
        }
        else
        {
            $colors = $colorsUrls;
        }

        $results = [];

        foreach ($colors as $color) {
            $colorInfo = new KotonColorScraper();
            $colorInfo = $colorInfo->getColor($color);
            $results[] = $colorInfo;
        }

        return $results;
    }

    public function getColorsUrls($uri): array
    {
        $client = new Client();
        $crawler = $client->request('GET', $uri);

        return $crawler->filter('.colorVariant')->each(function($node) {
            return 'https://www.koton.com' . $node->attr('href');
        });
    }
}
