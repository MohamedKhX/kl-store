<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;

class CityContoller extends Controller
{

    public function __construct()
    {
        App::setLocale('en');
    }

    public function index()
    {
        return view('dashboard.cities.index', [
            'cities' => City::all()
        ]);
    }

    public function create()
    {
        return view('dashboard.cities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'city_name'  => 'required|unique:cities,name',
            'city_price' => 'required'
        ]);

        $city = new City();
        $city->name = $request->input('city_name');
        $city->price = $request->input('city_price');
        $city->save();

        return redirect(route('admin.cities.index'))->with('success', 'City created successfully');
    }

    public function edit(City $city)
    {
        return view('dashboard.cities.edit', [
            'city' => $city
        ]);
    }

    public function update(Request $request, City $city)
    {
        $request->validate([
            'city_name'  => ['required', Rule::unique('cities', 'name')->ignore($city->id)],
            'city_price' => 'required'
        ]);

        $city->name  = $request->input('city_name');
        $city->price = $request->input('city_price');
        $city->save();

        return redirect(route('admin.cities.index'))->with('success', 'City updated successfully');
    }

    public function destroy(City $city)
    {
        $city->delete();
        return redirect(route('admin.cities.index'))->with('success', 'City deleted successfully');
    }
}
