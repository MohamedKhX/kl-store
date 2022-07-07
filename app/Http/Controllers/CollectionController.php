<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function show(Collection $collection)
    {
        return view('collections.show')->with([
            'products' => $collection->products
        ]);
    }
}
