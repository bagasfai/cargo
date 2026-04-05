<?php

namespace App\Http\Controllers;

use App\Http\Requests\DistrictRequest;
use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $districts = District::query()
            ->when($request->name, fn($q) => $q->where('name', 'like', "%{$request->name}%"))
            ->when($request->city_id, fn($q) => $q->where('city_id', $request->city_id))
            ->when($request->sort, function ($q) use ($request) {
                $q->orderBy($request->sort, $request->direction);
            })
            ->paginate(10)
            ->withQueryString();

        $cities = City::orderBy('name')->get();

        return view('district.index', compact('districts', 'cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::orderBy('name')->get();
        return view('district.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DistrictRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(District $district)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(District $district)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DistrictRequest $request, District $district)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(District $district)
    {
        //
    }
}
