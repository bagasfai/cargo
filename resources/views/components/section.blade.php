@props([
    'id' => null,
    'eyebrow' => null,
    'title' => null,
    'description' => null,
    'align' => 'center',
    'spacing' => 'py-14'
])

@php
    $alignment = match ($align) {
        'left' => 'text-left items-start',
        'right' => 'text-right items-end',
        default => 'text-center items-center',
    };
@endphp

<section {{ $attributes->class([$spacing]) }} @if ($id) id="{{ $id }}" @endif>
    <div class="mx-auto max-w-6xl px-4">
        @if ($title || $description || $eyebrow)
            <header class="flex flex-col gap-3 {{ $alignment }}">
                @if ($eyebrow)
                    <p class="text-lg font-semibold uppercase tracking-[0.3em] text-[#CD2028]">{{ $eyebrow }}</p>
                @endif
                @if ($title)
                    <h2 class="text-2xl font-bold leading-tight text-gray-900 sm:text-3xl md:text-4xl">{!! nl2br(e($title)) !!}</h2>
                @endif
                @if ($description)
                    <p class="text-base text-gray-600 md:text-lg">{{ $description }}</p>
                @endif
            </header>
        @endif
        <div class="mt-10">
            {{ $slot }}
        </div>
    </div>
</section>
