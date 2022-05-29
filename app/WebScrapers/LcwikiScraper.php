<?php

namespace App\WebScrapers;

use App\WebScrapers\Contracts\ScraperInterface;
use Goutte\Client;

class LcwikiScraper
{
    public function colors(string $uri)
    {
        $client = new Client();
        $crawler = $client->request('GET', $uri);


        $colors = $crawler->filter('.color-option')->each(function ($node) use($uri) {
            $nodeUrl = $node->attr('href');

            if(str_contains($nodeUrl, 'javascript')) {
                return [
                    'url'       => $uri,
                    'thumbnail' => $node->children()->first()->children()->attr('data-bg')
                ];
            }
            return [
                'url'       => $nodeUrl,
                'thumbnail' => $node->children()->first()->children()->attr('data-bg')
            ];
        });

        $colors = array_filter(
            array_map(
                function ($item) {
                    if(str_contains($item['url'], 'https://')) {
                        return [
                            'url'       => $item['url'],
                            'thumbnail' => $item['thumbnail']
                        ];
                    }
                    return [
                        'url'       => 'https://www.lcwaikiki.com/' . $item['url'],
                        'thumbnail' => $item['thumbnail']
                    ];
        }, $colors)
        , function($item) {
                return isset($item);
        }
        );

        $colors = array_values($colors);


        $results = [];

        foreach ($colors as $color) {
            $colorInfo = new LcWikiColorScraper();
            $colorInfo = $colorInfo->getColor($color['url'], $color['thumbnail']);
            $results[] = $colorInfo;
        }

        return $results;
    }
}
