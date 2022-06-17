<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Couchbase\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class CouponController extends Controller
{


    public function __construct()
    {
        App::setLocale('en');
    }

    public function index()
    {
        return view('dashboard.coupons.index', [
            'coupons' => Coupon::all()
        ]);
    }

    public function create()
    {
        return view('dashboard.coupons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'coupon_code'      => 'required|unique:coupons,code',
            'coupon_type'      => 'required',
            'coupon_value'     => 'required|integer',
            'coupon_max_users' => 'integer'
        ]);

        $status = (bool) $request->input('coupon_status');

        $coupon            = new Coupon();
        $coupon->code      = $request->input('coupon_code');
        $coupon->type      = $request->input('coupon_type');
        $coupon->status    = $status;
        $coupon->max_users = $request->input('coupon_max_users');

        if ($request->input('coupon_expire_at')) {
            $coupon->expire_at = Carbon::parse($request->input('coupon_expire_at'));
        }

        if ($coupon->type == 'fixed') {
            $coupon->value       = $request->input('coupon_value');
        } else {
            $coupon->percent_off = $request->input('coupon_value');
        }

        $coupon->save();

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon created successfully');
    }

    public function edit(Coupon $coupon)
    {
        return view('dashboard.coupons.edit', [
           'coupon' => $coupon
        ]);
    }

    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'coupon_code'  => ['required' , Rule::unique('coupons', 'code')->ignore($coupon->id)],
            'coupon_type'  => 'required',
            'coupon_value' => 'required|integer',
            'coupon_max_users' => 'integer'
        ]);

        $status = (bool) $request->input('coupon_status');

        $coupon->code      = $request->input('coupon_code');
        $coupon->type      = $request->input('coupon_type');
        $coupon->status    = $status;
        $coupon->max_users = $request->input('coupon_max_users');


        if ($request->input('coupon_expire_at')) {
            $coupon->expire_at = Carbon::parse($request->input('coupon_expire_at'));
        }

        if ($coupon->type == 'fixed') {
            $coupon->value       = $request->input('coupon_value');
        } else {
            $coupon->percent_off = $request->input('coupon_value');
        }

        $coupon->save();

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated successfully');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect(route('admin.coupons.index'))->with('success', 'Coupon deleted successfully');
    }
}
