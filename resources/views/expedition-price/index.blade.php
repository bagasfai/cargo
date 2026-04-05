@extends('layouts.app')

@section('content')
    <div class="flex justify-between mb-6">
        <x-ui.heading level="h1">Expedition Prices</x-ui.heading>
        <x-ui.button href="{{ route('expedition-prices.create') }}" variant="primary">
            Add Expedition Price
        </x-ui.button>
    </div>

    <x-table :columns="[
        [
            'label' => 'Province',
            'field' => 'province.name',
            'filter_key' => 'province_id',
            'filter' => [
                'type' => 'select',
                'options' => $provinces->pluck('name', 'id')->toArray(),
            ],
        ],
        [
            'label' => 'City',
            'field' => 'city.name',
            'filter_key' => 'city_id',
            'filter' => [
                'type' => 'select',
                'options' => $cities->pluck('name', 'id')->toArray(),
            ],
        ],
        [
            'label' => 'District',
            'field' => 'district.name',
        ],
        [
            'label' => 'Price/kg',
            'field' => 'price_per_kg',
            'format' => fn($row) => 'Rp ' . number_format($row->price_per_kg, 0, ',', '.'),
        ],
        [
            'label' => 'Min Weight',
            'field' => 'min_weight',
            'format' => fn($row) => $row->min_weight . ' kg',
        ],
        [
            'label' => 'Estimated Delivery',
            'field' => 'estimated_delivery_time',
        ],
        [
            'label' => 'Status',
            'field' => 'is_active',
            'format' => fn($row) => $row->is_active ? 'Active' : 'Inactive',
        ],
    ]" :rows="$expeditionPrices" route="{{ route('expedition-prices.index') }}" :actions="[
        'edit' => 'expedition-prices.edit',
        'delete' => 'expedition-prices.destroy',
    ]" />
@endsection
