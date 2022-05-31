<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Settings\GeneralSettings;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');

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
            'store_description'          => $settings->store_description,
            'phone_number'               => $settings->store_phone_number,
            'site_email'                 => $settings->store_email
        ]);
    }

    public function saveSettings(Request $request, GeneralSettings $settings)
    {
        $request->validate([
            'site_name' => 'required|max:32',
            'store_title' => 'required|max:64',
            'phone_number' => 'required|max:64',
            'site_email' => 'required|max:64',
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
        $settings->store_description  = $request->input('store_description');
        $settings->store_phone_number = $request->input('phone_number');
        $settings->store_email        = $request->input('site_email');

        $settings->save();

        return redirect()->back()->with('success', 'Settings saved successfully');
    }

    public function collections()
    {
        return view('dashboard.collections');
    }

    public function products()
    {
        return view('dashboard.products');
    }

    public function orders()
    {
        return view('dashboard.orders');
    }

    public function notifications()
    {
        return view('dashboard.notifications');
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
