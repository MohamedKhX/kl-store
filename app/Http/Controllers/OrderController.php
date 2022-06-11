<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('order');
    }

    public function store(Request $request)
    {

        //Validate
        $request->validate([

        ]);

        //Save order info

        //Save Products info


    }
}
