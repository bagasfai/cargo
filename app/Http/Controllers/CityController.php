<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest;
use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cities = City::query()
            ->with('province')
            ->when($request->name, fn($q) => $q->where('name', 'like', "%{$request->name}%"))
            ->when($request->province_id, fn($q) => $q->where('province_id', $request->province_id))
            ->when($request->sort, function ($q) use ($request) {
                $q->orderBy($request->sort, $request->direction);
            })
            ->paginate(10)
            ->withQueryString();

        $provinces = Province::orderBy('name')->get();

        return view('city.index', compact('cities', 'provinces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = Province::orderBy('name')->get();
        return view('city.create', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
    {
        City::create($request->validated());
        return redirect()->route('cities.index')->with('toasts', [[ 'type' => 'success', 'message' => 'City created successfully.' ]]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        $provinces = Province::orderBy('name')->get();
        return view('city.edit', compact('city', 'provinces'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, City $city)
    {
        $city->update($request->validated());
        return redirect()->route('cities.index')->with('toasts', [[ 'type' => 'success', 'message' => 'City updated successfully.' ]]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        $city->delete();
        return redirect()->route('cities.index')->with('toasts', [[ 'type' => 'success', 'message' => 'City deleted successfully.' ]]);
    }
}
