@extends('layouts.app')

@section('content')
    <div class="flex justify-between mb-6">
        <x-ui.heading level="h1">Provinces</x-ui.heading>
        <x-ui.button href="{{ route('provinces.create') }}" variant="primary">
            Add Province
        </x-ui.button>
    </div>

    <x-table :columns="[
        [
            'label' => 'Name',
            'field' => 'name',
            'filter' => ['type' => 'text'],
        ],
    ]" :rows="$provinces" route="{{ route('provinces.index') }}" :actions="[
        'edit' => 'provinces.edit',
        'delete' => 'provinces.destroy',
    ]" />
@endsection
