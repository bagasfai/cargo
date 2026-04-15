@extends('layouts.app')

@section('title', $blog->title)

@section('content')
    <div class="max-w-4xl mx-auto py-10 space-y-6">

        {{-- Back Button --}}
        <div>
            <a href="{{ route('blogs.index') }}"
               class="inline-flex items-center gap-2 rounded-lg border border-gray-300 dark:border-gray-700 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 transition hover:border-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Blog
            </a>
        </div>
        <h1 class="text-4xl font-bold text-gray-900 dark:text-gray-100">
            {{ $blog->title }}
        </h1>

        {{-- Meta --}}
        <div class="text-sm text-gray-500 dark:text-gray-400">
            {{ $blog->created_at->format('d M Y') }}
            · {{ $blog->categories->pluck('name')->join(', ') }}
        </div>

        {{-- Featured Image (Spatie Media Library) --}}
        @if ($blog->featured_image_url)
            <img src="{{ $blog->featured_image_url }}" alt="{{ $blog->title }}" class="w-full rounded-xl">
        @endif

        {{-- Content --}}
        <article class="prose dark:prose-invert max-w-none">
            {!! $blog->content !!}
        </article>

    </div>
@endsection
