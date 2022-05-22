<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Collection;
use App\Models\Product;
use Illuminate\Support\Facades\Request;

class PageController extends Controller
{
    public function home()
    {
        $categories = Category::all();

        $collections           = Collection::all();
        $bestDealsCollection   = $collections->where('slug', '=', 'best-deals')->first();
        $newArrivalsCollection = $collections->where('slug', '=', 'new-arrivals')->first();
        $bestSellersCollection = $collections->where('slug', '=', 'best-sellers')->first();
        $exclusiveCollection   = $collections->where('slug', '=', 'exclusive')->first();
        $otherCollections      = $categories->except([
            $bestDealsCollection->id,
            $newArrivalsCollection->id,
            $bestDealsCollection->id,
            $exclusiveCollection->id
        ]);



        return view('index')->with([
            'categories'            => $categories,
            'bestDealsCollection'   => $bestDealsCollection,
            'newArrivalsCollection' => $newArrivalsCollection,
            'bestSellersCollection' => $bestSellersCollection,
            'exclusiveCollection'   => $exclusiveCollection,
            'collections'           => $otherCollections
        ]);
    }

    public function faqs()
    {

    }

    public function contact()
    {

    }

    public function about()
    {

    }
}
