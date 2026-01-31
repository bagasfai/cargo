@extends('layouts.app')

@section('content')
    <div class="flex justify-between mb-6">
        <x-ui.heading level="h1">Districts</x-ui.heading>
        <x-ui.button href="{{ route('districts.create') }}" variant="primary">
            Add District
        </x-ui.button>
    </div>

    <x-table :columns="[
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
            'label' => 'Name',
            'field' => 'name',
            'filter' => ['type' => 'text'],
        ],
    ]" :rows="$districts" route="{{ route('districts.index') }}" :actions="[
        'edit' => 'districts.edit',
        'delete' => 'districts.destroy',
    ]" />
@endsection
