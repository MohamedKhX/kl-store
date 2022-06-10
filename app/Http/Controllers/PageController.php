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
        $categories = Category::all()->where('status', '=', '1');

        $collections           = Collection::all();
        $bestDealsCollection   = $collections->where('slug', '=', 'best-deals')->first();
        $newArrivalsCollection = $collections->where('slug', '=', 'new-arrivals')->first();
        $bestSellersCollection = $collections->where('slug', '=', 'best-sellers')->first();
        $otherCollections      = $collections->except([
            $bestDealsCollection->id,
            $newArrivalsCollection->id,
            $bestSellersCollection->id,
        ]);

        return view('home')->with([
            'categories'            => $categories,
            'bestDealsCollection'   => $bestDealsCollection,
            'newArrivalsCollection' => $newArrivalsCollection,
            'bestSellersCollection' => $bestSellersCollection,
            'collections'           => $otherCollections,
        ]);
    }

    public function faqs()
    {
        return view('faqs');
    }

    public function contact()
    {
        return view('contact-us');
    }

    public function about()
    {

    }
}
