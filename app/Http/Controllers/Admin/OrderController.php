<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductColors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class OrderController extends Controller
{


    public function __construct()
    {
        App::setLocale('en');
    }

    public function index()
    {
        $orders = Order::all();

        $requestedOrders   = $orders->where('status', '=', 'Requested');
        $refusedOrders     = $orders->where('status', '=', 'Refused');
        $acceptedOrders    = $orders->where('status', '=', 'Accepted');
        $inComingOrders    = $orders->where('status', '=', 'InComing');
        $inLibyaOrders     = $orders->where('status', '=', 'InLibya');
        $arrivedOrders     = $orders->where('status', '=', 'Arrived');
        $notResponseOrders = $orders->where('status', '=', 'Not Response');
        $notAcceptedOrders = $orders->where('status', '=', 'Not Accepted');


        return view('dashboard.orders.index', [
            'orders'            => $orders,
            'requestedOrders'   => $requestedOrders,
            'refusedOrders'     => $refusedOrders,
            'acceptedOrders'    => $acceptedOrders,
            'inComingOrders'    => $inComingOrders,
            'inLibyaOrders'     => $inLibyaOrders,
            'arrivedOrders'     => $arrivedOrders,
            'notResponseOrders' => $notResponseOrders,
            'notAcceptedOrders' => $notAcceptedOrders
        ]);
    }

    public function show(Order $order)
    {

        //Todo: Refactor this code

        $products = [];
        foreach ($order->products as $product) {
            $products[] = [
                'options'      => $product['options'],
                'qty'          => $product['qty'],
                'price'        => $product['price'],
                'thumbnail'    => $product['options']['thumbnail'],
                'name'         => $product['name'],
                'rowId'        => $product['rowId']
            ];
        }

        return view('dashboard.orders.show', [
            'order' => $order,
            'products' => $products
        ]);
    }

    public function fastUpdate(Order $order)
    {
        $order->status = \request()->input('status');
        $order->admin_notes = \request()->input('admin_notes');
        $order->save();

        return redirect()->back()->with('success', 'Order Updated Successfully');
    }
}
