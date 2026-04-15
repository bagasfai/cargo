<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProvinceRequest;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $provinces = Province::query()
        ->when($request->name, fn($q) => $q->where('name', 'like', "%{$request->name}%"))
        ->when($request->sort, function ($q) use ($request) {
            $q->orderBy($request->sort, $request->direction);
        })
        ->paginate(10)
        ->withQueryString();

        return view('province.index', compact('provinces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('province.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProvinceRequest $request)
    {
        Province::create($request->validated());

        return redirect()->route('provinces.index')->with('toasts', [['type' => 'success', 'message' => 'Province created successfully']]);
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
    public function edit(Province $province)
    {
        return view('province.edit', compact('province'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProvinceRequest $request, Province $province)
    {
        $province->update($request->validated());

        return redirect()->route('provinces.index')->with('toasts', [['type' => 'success', 'message' => 'Province updated successfully']]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Province $province)
    {
        $province->delete();

        return redirect()->route('provinces.index')->with('toasts', [['type' => 'success', 'message' => 'Province deleted successfully']]);
    }
}
