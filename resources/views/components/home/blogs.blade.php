@props(['posts' => collect()])

@if ($posts->isNotEmpty())
<x-section id="blog" eyebrow="Jangan Tertinggal" title="Informasi Terbaru dari Kami" description="Update rutin seputar layanan, tips logistik, dan cerita pelanggan." align="left">
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
        @foreach ($posts as $post)
            <a href="{{ route('blog.show', $post) }}" class="group flex">
                <article class="flex w-full flex-col rounded-3xl bg-[#CD2028] p-6 transition-transform group-hover:scale-[1.02]">

                    {{-- Thumbnail --}}
                    <img src="{{ $post->featured_image_url ?? 'https://placehold.co/600x300' }}"
                         alt="{{ $post->title }}"
                         class="h-32 w-full shrink-0 rounded-2xl object-cover">

                    {{-- Body: fills remaining height --}}
                    <div class="mt-4 flex flex-1 flex-col justify-between gap-4">
                        <div class="space-y-2">
                            <h3 class="text-lg font-semibold text-white">{{ $post->title }}</h3>
                            <p class="text-sm text-white/80">{{ Str::limit($post->excerpt, 100) }}</p>
                        </div>

                        {{-- CTA: span styled as button (nested <a> would be invalid HTML) --}}
                        <span class="inline-flex w-full items-center justify-center rounded-2xl bg-white/20 px-4 py-2 text-sm font-semibold text-white ring-1 ring-white/30 transition group-hover:bg-white/30">
                            Baca Selengkapnya
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </span>
                    </div>

                </article>
            </a>
        @endforeach
    </div>
</x-section>
@endif
