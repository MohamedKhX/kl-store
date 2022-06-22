<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Collection;
use App\Models\Contact;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
            'name' => 'required',
            'email' => 'required|email',
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

    public function about()
    {

    }
}
