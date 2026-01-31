@extends('layouts.app')

@section('title', 'User')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex justify-between items-center">
            <x-ui.heading level="h1">User</x-ui.heading>

            <a href="{{ route('users.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">
                ← Back to Users
            </a>
        </div>

            <div class="grid grid-cols-1 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <x-form.input name="name" label="Name" placeholder="Enter user name" :value="old('name', $user->name)" />
                    <x-form.textarea name="description" label="Description"
                        placeholder="Short description for SEO & preview" :value="old('description', $user->description)" />
                </div>
            </div>

    </div>
@endsection
