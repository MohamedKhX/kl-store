<?php

namespace App\Http\Controllers;

use App\Models\ProductColors;
use Illuminate\Http\Request;

class ProductColorsController extends Controller
{

    public function index()
    {
        return view('home')->with('products', ProductColors::all());
    }


    public function create()
    {

    }


    public function store(Request $request)
    {

    }


    public function show(ProductColors $product)
    {

    }

    public function edit(ProductColors $product)
    {

    }


    public function update(Request $request, ProductColors $product)
    {

    }

    public function destroy(ProductColors $product)
    {

    }
}
