<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Settings\GeneralSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

class DashboardController extends Controller
{


    public function __construct()
    {
        App::setLocale('en');
    }

    public function index()
    {
        $products = Product::all();
        $productViews = 0;

        foreach ($products as $product) {
            $productViews += $product->views;
        }

        $orders = Order::all();
        $ordersCount = $orders->count();

        $todayOrders = Order::where('status', '=', 'Requested')->whereDate('created_at', Carbon::today())->get();
        $todayOrdersCount = $todayOrders->count();

        $arrivedOrdersToday = Order::where('status', '=', 'arrived')->whereDate('updated_at', Carbon::today())->get();
        $todaySales = 0;

        foreach ($arrivedOrdersToday as $order) {
            $todaySales += $order->priceWithOutShipping();
        }

        $allArrivedOrders = Order::where('status', '=', 'arrived')->whereDate('updated_at', Carbon::today())->get();
        $totalSales = 0;
        foreach ($allArrivedOrders as $order) {
            $totalSales += $order->priceWithOutShipping();
        }

        return view('dashboard.index')->with([
            'productViews'      => $productViews,
            'ordersCount'       => $ordersCount,
            'todayOrdersCount'  => $todayOrdersCount,
            'todaySales'        => $todaySales,
            'totalSales'        => $totalSales,
        ]);
    }

    public function settings(GeneralSettings $settings)
    {
        return view('dashboard.settings')->with([
            'app_active'                 => $settings->app_active,
            'ability_to_create_accounts' => $settings->ability_to_create_accounts,
            'ability_to_login'           => $settings->ability_to_login,
            'ability_to_order'           => $settings->ability_to_order,
            'site_name'                  => $settings->site_name,
            'store_title'                => $settings->store_title,
            'store_title_ar'             => $settings->store_title_ar,
            'store_description'          => $settings->store_description,
            'store_description_ar'       => $settings->store_description_ar,
            'phone_number'               => $settings->store_phone_number,
            'site_email'                 => $settings->store_email,
            'store_thumbnail'            => $settings->store_thumbnail,
            'store_icon'                 => $settings->store_icon,
        ]);
    }

    public function saveSettings(Request $request, GeneralSettings $settings)
    {
        $request->validate([
            'site_name'       => 'required|max:32',
            'store_title'     => 'required|max:64',
            'store_title_ar'  => 'required|max:64',
            'phone_number'    => 'required|max:64',
            'site_email'      => 'required|max:64',
            'store_thumbnail' => '',
        ]);

        $app_active                 = $this->convertCheckBoxValueToBool($request->app_active);
        $ability_to_create_accounts = $this->convertCheckBoxValueToBool($request->ability_to_create_accounts);
        $ability_to_login           = $this->convertCheckBoxValueToBool($request->ability_to_login);
        $ability_to_order           = $this->convertCheckBoxValueToBool($request->ability_to_order);

        $settings->app_active                 = $app_active;
        $settings->ability_to_create_accounts = $ability_to_create_accounts;
        $settings->ability_to_login   = $ability_to_login;
        $settings->ability_to_order   = $ability_to_order;
        $settings->site_name          = $request->input('site_name');
        $settings->store_title        = $request->input('store_title');
        $settings->store_title_ar        = $request->input('store_title_ar');
        $settings->store_description     = $request->input('store_description');
        $settings->store_description_ar  = $request->input('store_description_ar');
        $settings->store_phone_number = $request->input('phone_number');
        $settings->store_email        = $request->input('site_email');

        if($request->file('store_thumbnail')) {
            $store_thumbnail           = $request->file('store_thumbnail')->store('header_thumbnail', 'public');
            $settings->store_thumbnail = $store_thumbnail;
        }

        if($request->file('store_icon')) {
            $store_icon           = $request->file('store_icon')->store('logos', 'public');
            $settings->store_icon = $store_icon;
        }

        $settings->save();

        return redirect()->back()->with('success', 'Settings saved successfully');
    }

    public function profile()
    {
        return view('dashboard.profile');
    }

    public function accounts()
    {
        return view('dashboard.accounts');
    }

    protected function convertCheckBoxValueToBool(?string $value): bool
    {
        if($value === 'on') {
            return true;
        }
        return false;
    }
}
