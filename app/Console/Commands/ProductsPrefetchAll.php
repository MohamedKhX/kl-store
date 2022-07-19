<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class ProductsPrefetchAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:prefetchAll';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prefetch all products';

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $products = Product::whereNotNull('websiteScraper')->get();

        $this->info('Start Prefetching all products');
        $this->info('Products Count ' . $products->count());

        $start = now();
        foreach ($products as $product) {
            $this->call('products:prefetch', [
               'product' => $product->id
            ]);
        }
        $time = $start->diffInSeconds(now());
        $this->info('all Products Prefetched successfully in ' . $time. 's');
    }
}
