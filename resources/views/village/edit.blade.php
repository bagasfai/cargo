@extends('layouts.app')

@section('title', 'Edit Village')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex justify-between items-center">
            <x-ui.heading level="h1">Edit Village</x-ui.heading>

            <a href="{{ route('villages.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">
                ← Back to Villages
            </a>
        </div>

        <form action="{{ route('villages.update', $village) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <x-form.input name="name" label="Name" placeholder="Enter village name" :value="old('name', $village->name)" />
                    <x-form.select-search name="district_id" label="District" :options="$districts->pluck('name', 'id')->toArray()" :value="old('district_id', $village->district_id)" />
                    <x-form.select-search name="id_jenis" label="Type" :options="['3' => 'Kelurahan', '4' => 'Desa']" :value="old('id_jenis', $village->id_jenis)" />
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('villages.index') }}"
                    class="px-4 py-2 rounded-lg border
                      text-gray-700 dark:text-gray-300
                      border-gray-300 dark:border-gray-700">
                    Cancel
                </a>

                <x-ui.button type="submit">
                    Update
                </x-ui.button>
            </div>
        </form>

    </div>
@endsection
