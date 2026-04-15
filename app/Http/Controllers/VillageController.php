<?php

namespace App\Http\Controllers;

use App\Http\Requests\VillageRequest;
use App\Models\District;
use App\Models\Village;
use Illuminate\Http\Request;

class VillageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $villages = Village::query()
            ->with('district')
            ->when($request->name, fn($q) => $q->where('name', 'like', "%{$request->name}%"))
            ->when($request->district_id, fn($q) => $q->where('district_id', $request->district_id))
            ->when($request->sort, function ($q) use ($request) {
                $q->orderBy($request->sort, $request->direction);
            })
            ->paginate(10)
            ->withQueryString();

        $districts = District::orderBy('name')->get();

        return view('village.index', compact('villages', 'districts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $districts = District::orderBy('name')->get();
        return view('village.create', compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VillageRequest $request)
    {
        Village::create($request->validated());
        return redirect()->route('villages.index')->with('toasts', [[ 'type' => 'success', 'message' => 'Village created successfully.' ]]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Village $village)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Village $village)
    {
        $districts = District::orderBy('name')->get();
        return view('village.edit', compact('village', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VillageRequest $request, Village $village)
    {
        $village->update($request->validated());
        return redirect()->route('villages.index')->with('toasts', [[ 'type' => 'success', 'message' => 'Village updated successfully.' ]]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Village $village)
    {
        $village->delete();
        return redirect()->route('villages.index')->with('toasts', [[ 'type' => 'success', 'message' => 'Village deleted successfully.' ]]);
    }
}
