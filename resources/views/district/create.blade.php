@extends('layouts.app')

@section('title', 'Create District')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex justify-between items-center">
            <x-ui.heading level="h1">Create District</x-ui.heading>

            <a href="{{ route('districts.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">
                ← Back to Districts
            </a>
        </div>

        <form action="{{ route('districts.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <x-form.input name="name" label="Name" placeholder="Enter district name" />
                    <x-form.select-search name="city_id" label="City" :options="$cities->pluck('name', 'id')->toArray()" />
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('districts.index') }}"
                    class="px-4 py-2 rounded-lg border
                      text-gray-700 dark:text-gray-300
                      border-gray-300 dark:border-gray-700">
                    Cancel
                </a>

                <x-ui.button type="submit">
                    Save
                </x-ui.button>
            </div>
        </form>

    </div>
@endsection
