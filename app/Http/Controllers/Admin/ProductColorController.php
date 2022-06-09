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
            'color_name'     => 'max:32',
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

    public function update(Request $request, Product $product, $colorId)
    {
        $request->validate([
            'color'           => 'max:32',
            'color_name'      => 'max:32',
            'color_price'     => 'required|int',
            'color_sizes'     => 'required',
            'color_thumbnail' => 'required'
        ]);

        $colorSizeNames = $request->input('color_sizes');
        $colorSizeQty   = $request->input('color_size_qty');
        $colorSizes = [];

        foreach ($colorSizeNames as $key => $sizeName) {
            if(is_null($sizeName)) {
                continue;
            }
            $colorSizes[] = [
                'size' => $sizeName,
                'qty'  => $colorSizeQty[$key]
            ];
        }

        $colorImages = $request->input('color_images');
        $images      = [];
        foreach ($colorImages as $image) {
            if(is_null($image)) {
                continue;
            }

            $images[] = $image;
        }

        if($request->input('color_custom_price')) {
            $price = $request->input('color_custom_price');
        } else {
            $price = $request->input('color_price');
        }

        $productColor               = $product->colors->find($colorId);
        $productColor->name         = $request->input('color_name');
        $productColor->color        = $request->input('color');
        $productColor->price        = $price;
        $productColor->images       = json_encode($images);
        $productColor->sizes        = json_encode($colorSizes);
        $productColor->thumbnail    = $request->input('color_thumbnail');
        $productColor->old_price    = $request->input('color_old_price');
        $productColor->custom_price = $request->input('color_custom_price');
        $productColor->save();

        return redirect()->back()->with('success', 'Color Updated Successfully');
    }
}
