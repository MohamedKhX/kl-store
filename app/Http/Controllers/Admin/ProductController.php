<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    public function index()
    {
        return view('dashboard.products.index')->with([
            'products' => Product::paginate(15),
        ]);
    }


    public function create()
    {
        return view('dashboard.products.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'product_name'      => 'min:2|max:32',
            'product_thumbnail' => 'required|image',
            'product_url'       => 'url'
        ]);

        $status = (bool) $request->input('product_status');
        $imgPath = $request->file('product_thumbnail')->store('product_thumbnails', 'public');

        $product                 = new Product();
        $product->category_id    = $request->input('product_category_id');
        $product->user_id        = $request->user()->id;
        $product->websiteScraper = $request->input('product_website_scraper');
        $product->url            = $request->input('url');
        $product->name           = $request->input('product_name');
        $product->description    = $request->input('product_description');
        $product->thumbnail      = $imgPath;
        $product->status         = $status;

        $product->save();

        return redirect(route('admin.products.color.create', ['product' => $product]));
    }


    public function show(Product $product)
    {
        return view('dashboard.products.show')->with(['product' => $product]);
    }


    public function edit(Product $product)
    {
        return view('dashboard.products.edit')->with(['product' => $product]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name'      => 'min:2|max32',
            'product_thumbnail' => 'image',
        ]);

        $status = (bool) $request->input('product_status');

        $product                 = Product::find($product->id);
        $product->category_id    = $request->input('product_category_id');
        $product->name           = $request->input('product_name');
        $product->description    = $request->input('product_description');
        $product->status         = $status;

        if($request->file('product_thumbnail')) {
            //Delete old image
            $oldPath = public_path('storage/' . $product->thumbnail);
            if(File::exists($oldPath)) {
                File::delete($oldPath);
            }
            //store the new one
            $imgPath = $request->file('category_thumbnail')->store('category_thumbnails', 'public');
            $product->thumbnail = $imgPath;
        }

        $product->save();

        return redirect(route('admin.products.index'))->with('success', 'Product updated successfully');
    }


    public function destroy(Product $product)
    {
        $imgPath = public_path('storage/' . $product->thumbnail);

        if(File::exists($imgPath)) {
            File::delete($imgPath);
        }

        $product->delete();

        return redirect(route('admin.products.index'))->with('success', 'Product deleted successfully');
    }


    public function deleteProductFromCategory(Product $product)
    {
        $product->category_id = null;
        $product->save();

        return redirect()->back()->with('success', 'Product deleted form category successfully');
    }
}
