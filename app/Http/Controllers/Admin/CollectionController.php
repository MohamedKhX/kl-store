<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class CollectionController extends Controller
{

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
            'collection_name'      => 'required|max:32|unique:collections,name',
            'collection_title'     => 'max:32',
            'collection_thumbnail'   => 'required|image',
            'collection_description' => '',
            'collection_status'      => ''
        ]);

        $status = (bool) $request->input('collection_status');
        $imgPath = $request->file('collection_thumbnail')->store('collection_thumbnails', 'public');


        $collection              = new Collection();
        $collection->user_id     = auth()->user()->id;
        $collection->slug        = str($request->input('collection_name'))->slug();
        $collection->name        = $request->input('collection_name');
        $collection->title       = $request->input('collection_title');
        $collection->description = $request->input('collection_description');
        $collection->status      = $status;
        $collection->thumbnail   = $imgPath;

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
            'collection_name'      => ['required', 'max:32', Rule::unique('collections', 'name')->ignore($collection->id)],
            'collection_title'     => 'max:32',
            'collection_thumbnail'   => 'image',
            'collection_description' => '',
            'collection_status'      => ''
        ]);

        $status = (bool) $request->input('collection_status');

        $collection              = Collection::find($collection->id);
        $collection->user_id     = auth()->user()->id;
        $collection->slug        = str($request->input('collection_name'))->slug();
        $collection->name        = $request->input('collection_name');
        $collection->description = $request->input('collection_description');
        $collection->status      = $status;

        if($request->file('collection_thumbnail')) {

            //Delete old image
            $oldPath = public_path('storage/' . $collection->thumbnail);
            if(File::exists($oldPath)) {
                File::delete($oldPath);
            }

            //store the new one
            $imgPath = $request->file('collection_thumbnail')->store('collection_thumbnails', 'public');
            $collection->thumbnail = $imgPath;
        }

        $collection->save();

        return redirect(route('admin.collections.index'))->with('success', 'Collection updated successfully');
    }


    public function destroy(Collection $collection)
    {
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
