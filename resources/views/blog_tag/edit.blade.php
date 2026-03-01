@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <x-ui.heading level="h1">Edit Blog Tag</x-ui.heading>
            <a href="{{ route('blog-tags.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">
                ← Back
            </a>
        </div>

        <form action="{{ route('blog-tags.update', $blogTag) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <x-form.input 
                name="name" 
                label="Tag Name" 
                placeholder="Enter tag name"
                value="{{ old('name', $blogTag->name) }}"
            />

            <x-form.input 
                name="slug" 
                label="Slug" 
                placeholder="tag-slug"
                value="{{ old('slug', $blogTag->slug) }}"
            />

            <div class="flex gap-3 pt-4 border-t border-gray-100 dark:border-gray-800">
                <a href="{{ route('blog-tags.index') }}"
                    class="px-4 py-2 rounded-lg border text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-700">
                    Cancel
                </a>
                <x-ui.button type="submit">
                    Update Tag
                </x-ui.button>
            </div>
        </form>
    </div>
@endsection
