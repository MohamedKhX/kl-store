<?php

namespace App\WebScrapers;

use App\WebScrapers\Contracts\ScraperInterface;
use Goutte\Client;
use function PHPUnit\Framework\stringContains;

class LcwikiScraper
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
            $colorInfo = new LcWikiColorScraper();
            $colorInfo = $colorInfo->getColor($color);
            $results[] = $colorInfo;
        }

        return $results;
    }

    public function getColorsUrls($uri): array
    {
        $client = new Client();
        $crawler = $client->request('GET', $uri);

        return array_Filter($crawler->filter('.color-option')->each(function ($node) use($uri) {
            if(str_contains($node->attr('class'), 'disabled')) {
                return null;
            }

            $nodeUrl = $node->attr('href');

            if(str_contains($nodeUrl, 'javascript')) {
                return $uri;
            }

            return 'https://www.lcwaikiki.com' .  $nodeUrl;
        }));
    }
}
