<?php

namespace App\Http\Controllers\Admin;

use App\Console\Commands\ProductReFetch;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Product;
use App\Models\ProductColors;
use App\WebScrapers\KotonScraper;
use App\WebScrapers\LcwikiScraper;
use App\WebScrapers\TrendyolScraper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{

    //Refactor this file

    public function __construct()
    {
        App::setLocale('en');
        set_time_limit(0);
    }

    public function index()
    {
        return view('dashboard.products.index')->with([
            'products' => Product::orderBy('updated_at', 'desc')->paginate(15),
        ]);
    }

    public function create()
    {
        return view('dashboard.products.create')->with([
            'categories' => Category::all(),
            'collections' => Collection::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name'      => 'required|min:2|max:32',
            'product_thumbnail' => 'required|image',
            'product_url'       => 'url',
            'product_price'     => 'nullable|integer',
            'product_old_price' => 'nullable|integer',
            'product_priority'  => 'nullable|integer'
        ]);


        $status   = (bool) $request->input('product_status');
        $imgPath  = $request->file('product_thumbnail')->store('product_thumbnails', 'public');
        $price    = $request->input('product_price');
        $oldPrice = $request->input('product_old_price');

        $product                 = new Product();
        $product->user_id        = $request->user()->id;
        $product->websiteScraper = $request->input('product_website_scraper');
        $product->url            = $request->input('url');
        $product->name           = $request->input('product_name');
        $product->description    = $request->input('product_description');
        $product->outer_description = $request->input('product_outer_description');
        $product->thumbnail      = $imgPath;
        $product->status         = $status;
        $product->price          = $price;
        $product->old_price      = $oldPrice;
        $product->priority = $request->input('product_priority');

        $product->save();

        $product->categories()->attach($request->input('categories'));
        $product->collections()->attach($request->input('collections'));

        return redirect(route('admin.products.color.create', ['product' => $product]));
    }

    public function show(Product $product)
    {
        return view('dashboard.products.show')->with(['product' => $product]);
    }

    public function edit(Product $product)
    {
        return view('dashboard.products.edit')->with([
            'product'     => $product,
            'categories'  => Category::all(),
            'collections' => Collection::all()
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name'      => 'min:2|max:32',
            'product_thumbnail' => 'image',
            'product_price'     => 'nullable|integer',
            'product_old_price' => 'nullable|integer',
            'product_priority'  => 'nullable|integer',
            'product_earnings'  => 'nullable|integer'
        ]);

        $urls = $request->input('url_fields');
        if($urls) {
            $urls = array_filter($urls);
        }

        $status = (bool) $request->input('product_status');

        $product                 = Product::find($product->id);
        $product->name           = $request->input('product_name');
        $product->description    = $request->input('product_description');
        $product->outer_description = $request->input('product_outer_description');
        $product->status         = $status;
        $product->priority       = $request->input('product_priority');
        $product->urls           = json_encode($urls);
        $product->fetchable      = (bool) $request->input('product_fetchable');



        if($request->input('product_earnings')) {
            if((int) $request->input('product_earnings') !== $product->earnings) {
                $product->earnings  = $request->input('product_earnings');
            }
        }

        $product->categories()->sync($request->input('categories'));
        $product->collections()->sync($request->input('collections'));

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

        $earnings = (int) $request->input('product_earnings');

        if($earnings != $product->earnings) {
            if($earnings) {
                foreach ($product->colors as $color) {
                    $color->price = round(transformCurrency((int) $color->price, $earnings) / 5) * 5;
                    $color->save();
                }
            }
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
            ->with([
                    'categories' => Category::all(),
                    'collections' => Collection::all()
                ]);
    }

    public function scrapStore(Request $request)
    {
        $request->validate([
            'product_name'       => 'required|max:32',
            'product_thumbnail'  => 'image',
            'product_url'        => 'required',
            'product_price'     => 'nullable|integer',
            'product_old_price' => 'nullable|integer',
            'product_priority'  => 'nullable|integer',
            'product_earnings'  => 'nullable|integer'
        ]);

        $urls = $request->input('url_fields');
        $status = (bool) $request->input('product_status');
        $website = $this->getWebSite($request->input('product_url'));

        if($website === false) {
            throw ValidationException::withMessages(['product_url' => 'This website is not supported']);
        }

        $price    = $request->input('product_price');
        $oldPrice = $request->input('product_old_price');

        $product = new Product();
        $product->websiteScraper = $website;
        $product->url            = $request->input('product_url');
        $product->user_id        = $request->user()->id;
        $product->name           = $request->input('product_name');
        $product->description    = $request->input('product_description');
        $product->outer_description = $request->input('product_outer_description');
        $product->status         = $status;
        $product->price          = $price;
        $product->old_price      = $oldPrice;
        $product->priority       = $request->input('product_priority');
        $product->urls           = json_encode($urls);
        $product->fetchable      = (bool) $request->input('product_fetchable');

        if($request->input('product_earnings')) {
            $product->earnings  = $request->input('product_earnings');
        }

        if($request->file('product_thumbnail')) {
            $imgPath = $request->file('product_thumbnail')->store('product_thumbnails', 'public');
            $product->thumbnail  = $imgPath;
        }

        $product->save();

        $product->categories()->attach($request->input('categories'));
        $product->collections()->attach($request->input('collections'));


        Artisan::call('products:prefetch', [
            'product' => $product->id
        ]);


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

        return redirect(route('admin.products.index'))->with('success', 'Product created successfully');
    }

    protected function getWebSite(string $url): bool|string
    {
        if(str_contains($url ,'lcwaikiki')) {
            return 'lcwaikiki-allColors';
        }

        if($url == 'lc') {
            return 'lcwaikiki-someColors';
        }

        if(str_contains($url, 'koton')) {
            return 'koton-allColors';
        }

        if($url == 'kt') {
            return 'koton-someColors';
        }

        if(str_contains($url, 'trendyol')) {
            return 'trendyol';
        }

        return false;
    }

    public function scrapUpdate(Product $product, ProductReFetch $productReFetch)
    {
        if(! $product->fetchable) {
            return redirect(route('admin.products.edit', $product))
                ->with('error', 'This Product is UnFetchable');
        }

        Artisan::call('products:prefetch', [
            'product' => $product->id
        ]);

        return redirect(route('admin.products.edit', $product))
            ->with('success', 'Prefetched successfully');
    }

    protected function updatePrice($product ,$price, $oldPrice = false)
    {
        foreach ($product->colors as $color) {
            if($oldPrice) {
                $color->old_price = $price;
                $color->save();
            } else {

                if(! is_null($color->custom_price)) {
                    continue;
                }

                $color->price = $price;
                $color->save();
            }
        }
    }

    public function replicate(Product $product)
    {
        //Create product instance
        $newProduct = $product->replicate();
        $newProduct->websiteScraper = null;
        $newProduct->url = null;
        $newProduct->urls = null;
        $newProduct->created_at = Carbon::now();
        $newProduct->save();

        //Create color instances
        foreach ($product->colors as $color) {
            $newColor = $color->replicate();
            $newColor->product_id = $newProduct->id;
            $newColor->created_at = Carbon::now();
            $newColor->save();
        }

        return redirect(route('admin.products.edit', $newProduct))->with('success', 'The product has been successfully cloned.  Note: this is the new product!');
    }
}
