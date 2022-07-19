<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\ProductColors;
use App\WebScrapers\KotonScraper;
use App\WebScrapers\LcwikiScraper;
use App\WebScrapers\TrendyolScraper;
use Illuminate\Console\Command;

class ProductReFetch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:prefetch
                            {product : The ID of the product}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'prefetch product';

    /*
     * Exception Counter
     * */
    protected int $exceptionCounter = 0;

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $productId = $this->argument('product');
        $product   = Product::find($productId);

        if(! $product) {
            $this->error('Product id ' . $productId . ' is not found');
            return;
        }

        if(! $product->websiteScraper) {
            $this->error('Product id ' . $productId . ' is Custom product');
        }

        $this->info('Start Fetching Product ID ' . $productId);
        $product->status = false;
        $product->save();

        try {
            $start = now();
            $this->scrap($product);
            $time = $start->diffInSeconds(now());

        } catch (\Exception $exception) {

            if($this->exceptionCounter >= 10) {
                return;
            }

            $this->exceptionCounter++;
            $this->handle();
            return;
        }

        $this->info('Completed in ' . $time . 's');

        $product->status = true;
        $product->save();
    }

    protected function scrap(Product $product)
    {
        $this->scrapColors(
            productId: $product->id,
            uri: $product->url,
            webScraper: $product->websiteScraper,
            urls: json_decode($product->urls, true)
        );
    }

    protected function getWebSite(string $url): bool|string
    {
        if(str_contains($url ,'lcwaikiki')) {
            return 'lcwaikiki-allColors';
        }

        if($url == 'lc') {
            return 'lcwaikiki-someColors';
        }

        if(str_contains($url, 'koton')) {
            return 'koton-allColors';
        }

        if($url == 'kt') {
            return 'koton-someColors';
        }

        if(str_contains($url, 'trendyol')) {
            return 'trendyol';
        }

        return false;
    }

    protected function scrapColors($productId, $uri, $webScraper, $urls = [])
    {
        if($webScraper == 'lcwaikiki-allColors' || $webScraper == 'lcwaikiki-someColors') {
            $scraper = new LcwikiScraper();
        }

        if($webScraper == 'koton-allColors' || $webScraper == 'koton-someColors') {
            $scraper = new KotonScraper();
        }

        if($webScraper == 'trendyol') {
            $scraper = new TrendyolScraper();
        }

        if($webScraper == 'trendyol' || $webScraper == 'koton-someColors' || $webScraper == 'lcwaikiki-someColors') {
            $colors = $scraper->colors(colorsUrls: $urls);
        } else {
            $colors = $scraper->colors($uri);
        }

        foreach ($colors as $color) {
            $this->updateProductColor($color, $productId);
        }
    }

    protected function updateProductColor(array $colorInfo, $productId)
    {
        $product = Product::find($productId);
        $price = round(transformCurrency((int) $colorInfo['price'], $product->earnings) / 5) * 5;

        $productColor = ProductColors::where('url', '=', $colorInfo['url'])->first();

        if(! $productColor) {
            $productColor = new ProductColors();
            $productColor->product_id = $product->id;
            $productColor->price = $price;
        }

        $productColor->thumbnail  = $colorInfo['thumbnail'];
        $productColor->url        = $colorInfo['url'];
        $productColor->images     = json_encode($colorInfo['images']);
        $productColor->sizes      = json_encode($colorInfo['sizes']);


        if(is_null($product->price)) {
            $productColor->price = $price;
        }

        if(! is_null($productColor->custom_price)) {
            $productColor->price = $productColor->custom_price;
        }

        $productColor->save();
    }

}
