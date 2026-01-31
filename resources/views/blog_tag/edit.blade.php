@extends('layouts.app')

@section('title', 'Edit Tag Blog')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex justify-between items-center">
            <x-ui.heading level="h1">Edit Tag Blog</x-ui.heading>

            <a href="{{ route('blog-tags.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">
                ← Back to Blog Tags
            </a>
        </div>

        <form action="{{ route('blog-tags.update', $blogTag) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <x-form.input name="name" label="Name" placeholder="Enter tag name" :value="old('name', $blogTag->name)" />
                    <x-form.textarea name="description" label="Description"
                        placeholder="Short description for SEO & preview" :value="old('description', $blogTag->description)" />
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('blog-tags.index') }}"
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
