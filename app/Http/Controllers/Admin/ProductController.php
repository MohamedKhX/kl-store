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
        return view('dashboard.products.create')->with([
            'categories' => Category::all()
        ]);
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
        return view('dashboard.products.edit')->with([
            'product'  => $product,
            'categories' => Category::all()
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name'      => 'min:2|max:32',
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
            $imgPath = $request->file('product_thumbnail')->store('product_thumbnails', 'public');
            $product->thumbnail = $imgPath;
        }

        $price    = $request->input('product_price');
        $oldPrice = $request->input('product_old_price');

        if($price) {
            $product->price = $price;
            $this->updatePrice($product, $price);
        } else {
            $product->price = null;
        }

        if($oldPrice) {
            $product->old_price = $oldPrice;
            $this->updatePrice($product, $oldPrice, true);
        } else {
            $product->old_price = null;
        }

        $product->save();

        return redirect(route('admin.products.edit', $product))->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $imgPath = public_path('storage/' . $product->thumbnail);

        if(File::exists($imgPath)) {
            File::delete($imgPath);
        }

        foreach ($product->colors as $color) {
            $color->delete();
        }

        $product->delete();

        return redirect(route('admin.products.index'))->with('success', 'Product deleted successfully');
    }

    public function scrap()
    {
        return view('dashboard.products.scrap')
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
            $product->thumbnail  = $imgPath;
        }

        $product->save();

        $this->scrapColors(
            productId: $product->id,
            uri: $product->url
        );

        return redirect(route('admin.products.index'))->with('success', 'Product created successfully');
    }

    protected function updatePrice($product ,$price, $oldPrice = false)
    {
        foreach ($product->colors as $color) {
            if($oldPrice) {
                $color->old_price = $price;
                $color->save();
            } else {
                $color->price = $price;
                $color->save();
            }
        }
    }

    public function scrapUpdate(Product $product)
    {
        /*
         * Create an array of custom prices
         * ReUpdate the new custom prices and the prices
         * */

        $oldPrices = [];

        foreach ($product->colors as $color) {

            $oldPrices[] = [
                'url'         => $color->url,
                'oldPrice'    => $color->old_price,
                'customPrice' => $color->custom_price,
            ];

            $color->delete();
        }

        $this->scrapColors(
            productId: $product->id,
            uri: $product->url
        );

        return redirect(route('admin.products.update-price', $product))
            ->with('oldPrices', $oldPrices);
    }

    public function updatePriceAfterScrap(Product $product)
    {
        $oldPrices = session('oldPrices');

        if($product->price) {
            $this->updatePrice($product, $product->price);
        }

        if($product->old_price) {
            $this->updatePrice($product, $product->old_price, true);
        }

        foreach ($product->colors as $color) {
            foreach ($oldPrices as $oldPrice) {
                if(! $color->url === $oldPrice['url']) continue;

                if(isset($oldPrice['oldPrice'])) {
                    $color->old_price = $oldPrice['oldPrice'];
                    $color->save();
                }

                if(isset($oldPrice['customPrice'])) {
                    $color->custom_price = $oldPrice['customPrice'];
                    $color->price        = $oldPrice['customPrice'];
                    $color->save();
                }
            }
        }

        return redirect(route('admin.products.edit', $product->id))->with('success', 'Re fetched data successfully');
    }

    public function scrapColors($productId, $uri)
    {
        $scraper = new LcwikiScraper();
        $colors = $scraper->colors($uri);

        foreach ($colors as $color) {
            $this->createProductColor($color, $productId);
        }
    }

    public function createProductColor(array $colorInfo, $productId)
    {
        $price = round(transformCurrency((int) $colorInfo['price']) / 5) * 5;

        $productColor             = new ProductColors();
        $productColor->product_id = $productId;
        $productColor->thumbnail  = $colorInfo['thumbnail'];
        $productColor->price      = $price;
        $productColor->url        = $colorInfo['url'];
        $productColor->images     = json_encode($colorInfo['images']);
        $productColor->sizes      = json_encode($colorInfo['sizes']);

        $productColor->save();
    }
}
