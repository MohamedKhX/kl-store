<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
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
        return view('dashboard.orders.show', [
            'order' => $order,
            'products' => $order->products
        ]);
    }
}
