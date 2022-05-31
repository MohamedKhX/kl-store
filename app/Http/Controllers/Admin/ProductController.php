<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColors;
use App\WebScrapers\LcwikiScraper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    public function index()
    {
        return view('dashboard.products.index')->with([
            'products' => Product::orderBy('created_at', 'desc')->paginate(15),
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

    public function scrap()
    {
        return view('Dashboard.products.scrap')
            ->with(['categories' => Category::all()]);
    }

    public function scrapStore(Request $request)
    {
        $request->validate([
            'product_name'       => 'required|max:32',
            'product_thumbnail'  => 'image',
            'product_website'    => 'required',
            'product_url'        => 'required'
        ]);



        $status = (bool) $request->input('product_status');

        $product = new Product();
        $product->websiteScraper = $request->input('product_website');
        $product->url            = $request->input('product_url');
        $product->user_id        = $request->user()->id;
        $product->category_id    = $request->input('product_category');
        $product->name           = $request->input('product_name');
        $product->description    = $request->input('product_description');
        $product->status         = $status;

        if($request->file('product_thumbnail')) {
            $imgPath = $request->file('product_thumbnail')->store('product_thumbnails', 'public');
            $product->thumbnail      = $imgPath;
        }

        $product->save();

        $this->scrapColors(
            productId: $product->id,
            uri: $product->url
        );

        return redirect(route('admin.products.index'))->with('success', 'Product created successfully');
    }

    public function scrapColors($productId, $uri)
    {
        //'https://www.lcwaikiki.com/tr-TR/TR/urun/LC-WAIKIKI/erkek/Gomlek/5677110/2379584'


        $scraper = new LcwikiScraper();
        $colors = $scraper->colors($uri);

        foreach ($colors as $color) {
            $this->createProductColor($color, $productId);
        }
    }

    public function createProductColor(array $colorInfo, $productId)
    {
        $productColor             = new ProductColors();
        $productColor->product_id = $productId;
        $productColor->thumbnail  = $colorInfo['thumbnail'];
        $productColor->price      = $colorInfo['price'];
        $productColor->url        = $colorInfo['url'];
        $productColor->images     = json_encode($colorInfo['images']);
        $productColor->sizes      = json_encode($colorInfo['sizes']);

        $productColor->save();
    }
}
