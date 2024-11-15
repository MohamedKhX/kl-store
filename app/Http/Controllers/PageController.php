<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Collection;
use App\Models\Contact;
use App\Models\Product;
use App\Models\ProductColors;
use App\Settings\GeneralSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\LaravelSettings\Settings;

class PageController extends Controller
{
    public function home()
    {
        $categories = Category::active()->get();
        $products   = Product::all();

        $collections           = Collection::all();
        $bestDealsCollection   = $collections->where('slug', '=', 'best-deals')->first();
        $newArrivalsCollection = $collections->where('slug', '=', 'new-arrivals')->first();
        $bestSellersCollection = $collections->where('slug', '=', 'best-sellers')->first();

        $activeCollections     = Collection::active()->get();

        $otherCollections      = $activeCollections->except([
            $bestDealsCollection->id   ?? null,
            $newArrivalsCollection->id ?? null,
            $bestSellersCollection->id ?? null,
        ]);

        return view('home')->with([
            'categories'            => $categories,
            'bestDealsCollection'   => $bestDealsCollection,
            'newArrivalsCollection' => $newArrivalsCollection,
            'bestSellersCollection' => $bestSellersCollection,
            'collections'           => $otherCollections,
            'products'              => $products
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

    public function contactStore(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email',
            'message' => 'required|min:15'
        ]);


        $contact = new Contact;

        $contact->name    = $request->input('name');
        $contact->email   = $request->input('email');
        $contact->message = $request->input('message');

        $contact->save();

        Mail::send('contact-us', [
           'name'    => $request->get('name'),
           'email'   => $request->get('email'),
           'message' => $request->get('message'),
        ], function ($message) use($request) {
             $message->from($request->email);
             $message->to('info@arkan.store');
        });

        return back()->with('success', __('flashMessages.thanks_for_contact_us'));
    }

    public function showProduct(Product $product, string $colorHash)
    {

        if(! $product->status) {
            return abort(404);
        }

        $is_numeric = is_numeric($colorHash);
        $colorId = ProductColors::where(function ($query) use($colorHash, $is_numeric) {
            if($is_numeric) {
                $query->where('id', '=', $colorHash);
            } else {
                $query->where('hash', '=', $colorHash);
            }
        })->first()->id;

        $collections = Collection::notSpecial()->get();
        $categories = Category::active()->get();

        return view('show', [
            'product' => $product,
            'colorId' => $colorId,
            'collections' => $collections,
            'categories' => $categories,
        ]);
    }

    public function showCollection(Collection $collection)
    {
        $collections = Collection::notSpecial()->get()->except([$collection->id]);
        $categories = Category::active()->get();

        return view('collection-show', [
            'collection' => $collection,
            'collections' => $collections,
            'categories' => $categories,
        ]);
    }

    public function privacy(GeneralSettings $settings)
    {
        return view('privacy-policy', [
            'privacy_description' => $settings->privacy_description
        ]);
    }

    public function savePrivacyDescription(GeneralSettings $settings)
    {
        $settings->privacy_description = \request()->input('privacy_description');
        $settings->save();

        return redirect(route('privacy'));
    }
}
