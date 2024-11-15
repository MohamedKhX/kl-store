<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class CollectionController extends Controller
{


    public function __construct()
    {
        App::setLocale('en');
    }

    public function index()
    {
        $collections = Collection::all();
        $specialCollections = $collections->where('special', '=', '1');
        $otherCollections   = $collections->where('special', '=', '0');

        return view('dashboard.collections.index')->with([
            'specialCollections' => $specialCollections,
            'collections'        => $otherCollections
        ]);
    }


    public function create()
    {
        return view('dashboard.collections.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'collection_name'        => 'required|max:32|unique:collections,name',
            'collection_title'       => 'max:32',
            'collection_thumbnail'   => 'required|image',
            'collection_background'  => 'nullable|image',
            'collection_description' => '',
            'collection_status'      => '',
            'collection_priority'    => 'numeric'
        ]);

        $status = (bool)  $request->input('collection_status');
        $thumbnailPath  = $request->file('collection_thumbnail')->store('collection_thumbnails', 'public');

        $backgroundPath = $request->file('collection_background');

        $backgroundPath?->store('collection_backgrounds', 'public');

        $collection              = new Collection();
        $collection->user_id     = auth()->user()->id;
        $collection->slug        = str($request->input('collection_name'))->slug();
        $collection->name        = $request->input('collection_name');
        $collection->description = $request->input('collection_description');
        $collection->status      = $status;
        $collection->thumbnail   = $thumbnailPath;
        $collection->priority    = (int) $request->input('collection_priority');

        $collection->save();

        return redirect(route('admin.collections.index'))->with('success', 'Collection created successfully');
    }


    public function show(Collection $collection)
    {
        return view('dashboard.collections.show')->with(['collection' => $collection]);
    }


    public function edit(Collection $collection)
    {
        return view('dashboard.collections.edit')->with(['collection' => $collection]);
    }

    public function update(Request $request, Collection $collection)
    {
        $request->validate([
            'collection_name'        => ['required', 'max:32', Rule::unique('collections', 'name')->ignore($collection->id)],
            'collection_title'       => 'max:32',
            'collection_thumbnail'   => 'image',
            'collection_background'  => 'nullable|image',
            'collection_description' => '',
            'collection_status'      => '',
            'collection_priority'    => 'numeric'
        ]);

        $status = (bool) $request->input('collection_status');

        $collection              = Collection::find($collection->id);
        $collection->user_id     = auth()->user()->id;
        $collection->name        = $request->input('collection_name');
        $collection->description = $request->input('collection_description');
        $collection->status      = $status;
        $collection->priority    = (int) $request->input('collection_priority');


        if(! $collection->special)
        {
            $collection->slug        = str($request->input('collection_name'))->slug();
        }

        if($request->file('collection_thumbnail'))
        {
            //Delete old image
            $oldPath = public_path('storage/' . $collection->thumbnail);
            if(File::exists($oldPath)) {
                File::delete($oldPath);
            }

            //store the new one
            $imgPath = $request->file('collection_thumbnail')->store('collection_thumbnails', 'public');
            $collection->thumbnail = $imgPath;
        }

        if($request->file('collection_background')) {

            //Delete old image
            $oldPath = public_path('storage/' . $collection->background);
            if(File::exists($oldPath)) {
                File::delete($oldPath);
            }

            //store the new one
            $imgPath = $request->file('collection_background')->store('collection_backgrounds', 'public');
            $collection->background = $imgPath;
        }

        $collection->save();

        return redirect(route('admin.collections.index'))->with('success', 'Collection updated successfully');
    }


    public function destroy(Collection $collection)
    {
        if($collection->special) {
            return redirect(route('admin.collections.index'))->with('error', 'You cant delete a special collection');
        }

        $imgPath = public_path('storage/' . $collection->thumbnail);

        if(File::exists($imgPath)) {
            File::delete($imgPath);
        }

        $collection->delete();

        return redirect(route('admin.collections.index'))->with('success', 'Collection deleted successfully');
    }

    public function deleteProductFromCollection(Collection $collection, Product $product)
    {
        $collection->products()->detach($product->id);
        return redirect()->back()->with('success', 'Product deleted from collection successfully');
    }
}
