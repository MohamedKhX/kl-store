<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductColors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\ValidationException;
use function PHPUnit\Framework\isNull;

class ProductColorController extends Controller
{

    //Refactor this file

    public function __construct()
    {
        App::setLocale('en');
    }

    public function create(Product $product)
    {
        return view('dashboard.products.create-color')->with(['product' => $product]);
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'color'          => 'max:32',
            'color_name'     => 'max:32',
            'color_price'    => 'required|integer',
            'color_old_price' => 'nullable|integer',
            'color_custom_price' => 'nullable|integer',
            'color_sizes'    => 'required',
            'color_thumbnail' => 'required|image',
        ]);

        $colorSizeNames = $request->input('color_sizes');
        $colorSizeQty   = $request->input('color_size_qty');
        $colorSizes = [];


        //Validate the quantity
        foreach ($colorSizeQty as $qty) {
            if(is_null($qty)) continue;

            if(! is_numeric($qty)) {
                throw ValidationException::withMessages(['color_size_qty' => 'The quantity field must be a number']);
            }
        }

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

        if(! collect($images)->count()) {
            throw ValidationException::withMessages(['images' => 'image fields are required at least one']);
        }

        if($request->input('color_custom_price')) {
            $price = $request->input('color_custom_price');
        } else {
            $price = $request->input('color_price');
        }

        $thumbnail = $request->file('color_thumbnail')->store('color_thumbnails', 'public');

        $productColor               = new ProductColors();
        $productColor->product_id   = $product->id;
        $productColor->name         = $request->input('color_name');
        $productColor->color        = $request->input('color');
        $productColor->price        = $price;
        $productColor->images       = json_encode($images);
        $productColor->sizes        = json_encode($colorSizes);
        $productColor->thumbnail    = $thumbnail;
        $productColor->old_price    = $request->input('color_old_price');
        $productColor->custom_price = $request->input('color_custom_price');


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
            'color_price'    => 'required|integer',
            'color_old_price' => 'nullable|integer',
            'color_custom_price' => 'nullable|integer',
            'color_sizes'     => 'required',
            'color_thumbnail' => ''
        ]);

        $colorSizeNames = $request->input('color_sizes');
        $colorSizeQty   = $request->input('color_size_qty');
        $colorSizes = [];


        //Validate the quantity
        foreach ($colorSizeQty as $qty) {
            if(is_null($qty)) continue;

            if(! is_numeric($qty)) {
                throw ValidationException::withMessages(['color_size_qty' => 'The quantity field must be a number']);
            }
        }

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

        if(! collect($images)->count()) {
            throw ValidationException::withMessages(['images' => 'image fields are required at least one']);
        }


        $colorExcludedImagesRequest = $request->input('color_exclude_img');
        $colorExcludedImages = [];
        foreach ($colorExcludedImagesRequest as $image) {
            if(is_null($image)) {
                continue;
            }

            $colorExcludedImages[] = $image;
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
        $productColor->old_price    = $request->input('color_old_price');
        $productColor->custom_price = $request->input('color_custom_price');
        $productColor->excludedImages = json_encode($colorExcludedImages);


        if($request->input('color_thumbnail')) {
            $thumbnail               = $request->file('color_thumbnail')->store('color_thumbnails', 'public');
            $productColor->thumbnail = $thumbnail;
        }


        $productColor->save();

        return redirect()->back()->with('success', 'Color Updated Successfully');
    }

    public function destroy(Product $product, $colorId)
    {
        $color = ProductColors::find($colorId);
        $color->delete();

        return redirect(route('admin.products.edit', $product->id))->with('success', 'Color Deleted Successfully');
    }
}
