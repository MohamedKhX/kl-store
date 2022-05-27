<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        return view('dashboard.categories.index')->with([
            'categories' => Category::all()
        ]);
    }


    public function create()
    {
        return view('dashboard.categories.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'category_name'        => 'required|max:32',
            'category_thumbnail'   => 'required|image',
            'category_description' => '',
            'category_status'      => ''
        ]);

        $status = (bool) $request->input('category_status');
        $imgPath = $request->file('category_thumbnail')->store('category_thumbnails', 'public');


        $category              = new Category();
        $category->user_id     = auth()->user()->id;
        $category->slug        = str($request->input('category_name'))->slug();
        $category->name        = $request->input('category_name');
        $category->description = $request->input('category_description');
        $category->status      = $status;
        $category->thumbnail   = $imgPath;

        $category->save();

        return redirect(route('admin.categories.index'))->with('success', 'Category created successfully');
    }


    public function show(Category $category)
    {
        return view('dashboard.categories.show')->with(['category' => $category]);
    }


    public function edit(Category $category)
    {
        return view('dashboard.categories.edit')->with(['category' => $category]);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
           'category_name'        => 'required|max:32',
           'category_thumbnail'   => 'image',
           'category_description' => '',
           'category_status'      => ''
        ]);

        $status = (bool) $request->input('category_status');

        $category              = Category::find($category)->first();
        $category->user_id     = auth()->user()->id;
        $category->slug        = str($request->input('category_name'))->slug();
        $category->name        = $request->input('category_name');
        $category->description = $request->input('category_description');
        $category->status      = $status;

        if($request->file('category_thumbnail')) {
            $imgPath = $request->file('category_thumbnail')->store('category_thumbnails', 'public');
            $category->thumbnail = $imgPath;
        }

        $category->save();

        return redirect(route('admin.categories.index'))->with('success', 'Category updated successfully');
    }


    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully');
    }
}
