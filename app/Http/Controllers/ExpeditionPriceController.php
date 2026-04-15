<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpeditionPriceRequest;
use App\Models\City;
use App\Models\District;
use App\Models\ExpeditionPrice;
use App\Models\Province;
use App\Models\Village;
use Illuminate\Http\Request;

class ExpeditionPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $expeditionPrices = ExpeditionPrice::query()
            ->with(['province', 'city', 'district', 'village'])
            ->when($request->province_id, fn($q) => $q->where('province_id', $request->province_id))
            ->when($request->city_id, fn($q) => $q->where('city_id', $request->city_id))
            ->when($request->sort, function ($q) use ($request) {
                $q->orderBy($request->sort, $request->direction);
            })
            ->paginate(10)
            ->withQueryString();

        $provinces = Province::orderBy('name')->get();
        $cities = City::orderBy('name')->get();

        return view('expedition-price.index', compact('expeditionPrices', 'provinces', 'cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = Province::orderBy('name')->get();

        return view('expedition-price.create', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpeditionPriceRequest $request)
    {
        ExpeditionPrice::create($request->validated());

        return redirect()
            ->route('expedition-prices.index')
            ->with('toasts', [['type' => 'success', 'message' => 'Expedition price created successfully.']]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ExpeditionPrice $expeditionPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExpeditionPrice $expeditionPrice)
    {
        $expeditionPrice->load(['province', 'city', 'district', 'village']);
        $provinces = Province::orderBy('name')->get();
        $cities = City::where('province_id', $expeditionPrice->province_id)->orderBy('name')->get();
        $districts = District::where('city_id', $expeditionPrice->city_id)->orderBy('name')->get();
        $villages = $expeditionPrice->district_id
            ? Village::where('district_id', $expeditionPrice->district_id)->orderBy('name')->get()
            : collect();

        return view('expedition-price.edit', compact('expeditionPrice', 'provinces', 'cities', 'districts', 'villages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpeditionPriceRequest $request, ExpeditionPrice $expeditionPrice)
    {
        $expeditionPrice->update($request->validated());

        return redirect()
            ->route('expedition-prices.index')
            ->with('toasts', [['type' => 'success', 'message' => 'Expedition price updated successfully.']]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExpeditionPrice $expeditionPrice)
    {
        $expeditionPrice->delete();

        return redirect()
            ->route('expedition-prices.index')
            ->with('toasts', [['type' => 'success', 'message' => 'Expedition price deleted successfully.']]);
    }
}
