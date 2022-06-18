<?php

namespace App\WebScrapers;

class TrendyolScraper
{
    public function colors(array $colors)
    {
        $results = [];

        foreach ($colors as $color) {
            $colorInfo = new TrendyolColorScraper();
            $colorInfo = $colorInfo->getColor($color);
            $results[] = $colorInfo;
        }

        return $results;
    }
}
