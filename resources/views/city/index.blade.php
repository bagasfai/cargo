@extends('layouts.app')

@section('content')
    <div class="flex justify-between mb-6">
        <x-ui.heading level="h1">Cities</x-ui.heading>
        <x-ui.button href="{{ route('cities.create') }}" variant="primary">
            Add City
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
            'label' => 'Name',
            'field' => 'name',
            'filter' => ['type' => 'text'],
        ],
    ]" :rows="$cities" route="{{ route('cities.index') }}" :actions="[
        'edit' => 'cities.edit',
        'delete' => 'cities.destroy',
    ]" />
@endsection
