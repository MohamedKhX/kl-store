<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {

    }


    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show(Category $category)
    {
        $categories = Category::active()->get();
        $products   = Product::all();

        return view('categories.show', [
            'categories'      => $categories,
            'currentCategory' => $category,
            'products'        => $products
        ]);
    }


    public function edit(Category $category)
    {

    }

    public function update(Request $request, Category $category)
    {

    }


    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully');
    }
}
