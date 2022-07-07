<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product, $color = 1)
    {
        $colorId = +$color;


        if(isset($product->colors[$color - 1])) {
            $color   = $product->colors[$color - 1];
        } else {
            abort(404);
        }

        return view('products.show')->with([
            'product' => $product,
            'color'   => $color,
            'colorId' => $colorId
        ]);
    }
}
