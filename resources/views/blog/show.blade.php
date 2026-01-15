@extends('layouts.app')

@section('title', $blog->title)

@section('content')
    <div class="max-w-4xl mx-auto py-10 space-y-6">

        {{-- Title --}}
        <h1 class="text-4xl font-bold text-gray-900 dark:text-gray-100">
            {{ $blog->title }}
        </h1>

        {{-- Meta --}}
        <div class="text-sm text-gray-500 dark:text-gray-400">
            {{ $blog->created_at->format('d M Y') }}
            · {{ $blog->categories->pluck('name')->join(', ') }}
        </div>

        {{-- Featured Image --}}
        @if ($blog->featured_image)
            <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full rounded-xl">
        @endif

        {{-- Content --}}
        <article class="prose dark:prose-invert max-w-none">
            {!! $blog->content !!}
        </article>

    </div>
@endsection
