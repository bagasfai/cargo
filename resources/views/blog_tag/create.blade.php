@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <x-ui.heading level="h1">Create Blog Tags</x-ui.heading>
            <a href="{{ route('blog-tags.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">
                ← Back
            </a>
        </div>

        <form action="{{ route('blog-tags.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="space-y-4">
                @include('blog_tag.multi-tag-input')
            </div>

            <div class="flex gap-3 pt-4 border-t border-gray-100 dark:border-gray-800">
                <a href="{{ route('blog-tags.index') }}"
                    class="px-4 py-2 rounded-lg border text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-700">
                    Cancel
                </a>
                <x-ui.button type="submit">
                    Save Tags
                </x-ui.button>
            </div>
        </form>
    </div>
@endsection
