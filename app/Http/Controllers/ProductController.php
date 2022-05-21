<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        return view('home')->with(['products' => Product::all()]);
    }


    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show(Product $wholeProduct)
    {

    }

    public function edit(Product $wholeProduct)
    {

    }

    public function update(Request $request, Product $wholeProduct)
    {

    }


    public function destroy(Product $wholeProduct)
    {

    }
}
