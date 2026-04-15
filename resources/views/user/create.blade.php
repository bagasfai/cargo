@extends('layouts.app')

@section('title', 'Create Category Blog')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex justify-between items-center">
            <x-ui.heading level="h1">Create Category Blog</x-ui.heading>

            <a href="{{ route('users.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">
                ← Back to Blog Categories
            </a>
        </div>

        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <x-form.input name="name" label="Name" placeholder="Enter name" />
                    <x-form.input name="email" label="Email" placeholder="Enter email" />
                    <x-form.input name="password" type="password" label="Password" placeholder="Enter password" />
                    <x-form.input name="password_confirmation" type="password" label="Confirm Password"
                        placeholder="Confirm password" />
                    <x-form.select name="role" label="Role" :options="$roles->pluck('name', 'name')->toArray()" placeholder="Select role" />

                </div>
            </div>

            {{-- Actions --}}
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('users.index') }}"
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
