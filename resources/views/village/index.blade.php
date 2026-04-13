@extends('layouts.app')

@section('content')
    <div class="flex justify-between mb-6">
        <x-ui.heading level="h1">Villages</x-ui.heading>
        <x-ui.button href="{{ route('villages.create') }}" variant="primary">
            Add Village
        </x-ui.button>
    </div>

    <x-table :columns="[
        [
            'label' => 'District',
            'field' => 'district.name',
            'filter_key' => 'district_id',
            'filter' => [
                'type' => 'select',
                'options' => $districts->pluck('name', 'id')->toArray(),
            ],
        ],
        [
            'label' => 'Name',
            'field' => 'name',
            'filter' => ['type' => 'text'],
        ],
    ]" :rows="$villages" route="{{ route('villages.index') }}" :actions="[
        'edit' => 'villages.edit',
        'delete' => 'villages.destroy',
    ]" />
@endsection
