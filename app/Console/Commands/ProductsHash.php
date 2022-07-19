<?php

namespace App\Console\Commands;

use App\Models\ProductColors;
use Illuminate\Console\Command;

class ProductsHash extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:hash';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Give all products colors a hash';

    /**
     * Execute the console command.
     *
     */
    public function handle(): void
    {
        $allColors = ProductColors::all();

        $colorsHashed = 0;
        $colorsHashedAsNull = 0;

        foreach ($allColors as $color) {
            if(is_null($color->url)) {
                $color->hash = null;
                $color->save();

                $colorsHashedAsNull++;
                continue;
            }

            $url = explode('?', $color->url)[0];
            $url = explode('#', $url)[0];

            $color->hash = toBase62(crc32(substr($url, -10)));
            $color->save();

            $colorsHashed++;
        }

        $this->info('Products Hashed Successfully');
        $this->info('Products Hashed ' . $colorsHashed);
        $this->info('Products Hashed as null ' . $colorsHashedAsNull);
    }
}
