@extends('layouts.app')

@section('title', 'Create Category Blog')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex justify-between items-center">
            <x-ui.heading level="h1">Create Category Blog</x-ui.heading>

            <a href="{{ route('blog-categories.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">
                ← Back to Blog Categories
            </a>
        </div>

        <form action="{{ route('blog-categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <x-form.input name="name" label="Name" placeholder="Enter category name" />
                    <x-form.textarea name="description" label="Description"
                        placeholder="Short description for SEO & preview" />

                </div>
            </div>

            {{-- Actions --}}
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('blog-categories.index') }}"
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
