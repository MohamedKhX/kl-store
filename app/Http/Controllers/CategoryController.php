<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
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
}
