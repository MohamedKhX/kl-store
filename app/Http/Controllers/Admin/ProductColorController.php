<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductColors;
use Illuminate\Http\Request;

class ProductColorController extends Controller
{
    public function create(Product $product)
    {
        return view('dashboard.products.create-color')->with(['product' => $product]);
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'color'          => 'max:32',
            'color_name'     => 'required|max:32',
            'color_price'    => 'required',
            'color_sizes'    => 'required'
        ]);

        $colorSizes = explode(',', str($request->input('color_sizes'))->upper());

        $productColor             = new ProductColors();
        $productColor->product_id = $product->id;
        $productColor->name       = $request->input('color_name');
        $productColor->color      = $request->input('color');
        $productColor->price      = $request->input('color_price');
        $productColor->images     = json_encode($request->input('color_images'));
        $productColor->sizes      = json_encode($colorSizes);

        $productColor->save();

        return redirect(route('admin.products.color.create', $product))->with('success', 'Color created successfully');
    }

    public function edit(Product $product, $colorId)
    {
        $color = $product->colors->find($colorId);

        return view('dashboard.products.edit-color')->with([
            'product' => $product,
            'color'   => $color
        ]);
    }
}
