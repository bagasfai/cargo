@extends('layouts.app')

@section('title', 'Edit Tag Blog')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex justify-between items-center">
            <x-ui.heading level="h1">Edit Category Blog</x-ui.heading>

            <a href="{{ route('blog-categories.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">
                ← Back to Blog Categories
            </a>
        </div>

        <form action="{{ route('blog-categories.update', $blogCategory) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <x-form.input name="name" label="Name" placeholder="Enter category name" :value="old('name', $blogCategory->name)" />
                    <x-form.textarea name="description" label="Description"
                        placeholder="Short description for SEO & preview" :value="old('description', $blogCategory->description)" />
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Actions --}}
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('blog-categories.index') }}"
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
