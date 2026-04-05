<x-layouts.public :title="$blog->seo_title ?: $blog->title">
    <x-navbar />

    <main class="flex-1">
        <article class="max-w-4xl mx-auto px-4 py-12 sm:px-6 lg:px-8">

            {{-- Back Link --}}
            <a href="{{ url('/') }}" class="mb-6 inline-flex items-center gap-2 text-sm font-medium text-gray-500 transition hover:text-[#CD2028]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Home
            </a>

            {{-- Categories --}}
            @if ($blog->categories->isNotEmpty())
                <div class="mb-4 flex flex-wrap gap-2">
                    @foreach ($blog->categories as $category)
                        <span class="inline-block rounded-full bg-red-50 px-3 py-1 text-xs font-medium text-red-700">
                            {{ $category->name }}
                        </span>
                    @endforeach
                </div>
            @endif

            {{-- Title --}}
            <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl lg:text-5xl">
                {{ $blog->title }}
            </h1>

            {{-- Meta --}}
            <div class="mt-4 flex items-center gap-4 text-sm text-gray-500">
                @if ($blog->author)
                    <span>{{ $blog->author->name }}</span>
                    <span>&middot;</span>
                @endif
                <time datetime="{{ $blog->published_at->toDateString() }}">
                    {{ $blog->published_at->format('d M Y') }}
                </time>
            </div>

            {{-- Featured Image --}}
            @if ($blog->featured_image_url)
                <div class="mt-8">
                    <img src="{{ $blog->featured_image_url }}"
                         alt="{{ $blog->title }}"
                         class="w-full rounded-2xl object-cover shadow-lg"
                         loading="lazy">
                </div>
            @endif

            {{-- Content --}}
            <div class="prose prose-lg prose-gray mx-auto mt-10 max-w-none">
                {!! $blog->content !!}
            </div>

            {{-- Tags --}}
            @if ($blog->tags->isNotEmpty())
                <div class="mt-10 flex flex-wrap gap-2 border-t border-gray-100 pt-6">
                    @foreach ($blog->tags as $tag)
                        <span class="inline-block rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600">
                            #{{ $tag->name }}
                        </span>
                    @endforeach
                </div>
            @endif

        </article>
    </main>

    <x-footer />
</x-layouts.public>
