@props([
    'title' => null,
    'description' => null,
    'icon' => null,
    'iconAlt' => null,
    'variant' => 'solid',
    'orientation' => 'vertical',
    'titleClass' => null,
])

@php
    $variants = [
        'solid' => 'bg-white text-gray-900 shadow-sm shadow-gray-200/70',
        'outline' => 'border border-gray-200 bg-white text-gray-900',
        'muted' => 'bg-gray-50 text-gray-900',
        'accent' => 'bg-[#CD2028] text-white',
        'plain' => 'text-gray-900',
    ];

    $cardBase = $variants[$variant] ?? $variants['solid'];
    $layout = $orientation === 'horizontal'
        ? 'flex items-start gap-4 text-left'
        : 'flex flex-col items-center gap-4 text-center';
@endphp

<article {{ $attributes->class(["rounded-3xl p-6", $cardBase, $layout]) }}>
    @if ($icon)
        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white/70">
            <img src="{{ $icon }}" alt="{{ $iconAlt ?? $title }}" class="h-10 w-10 object-contain">
        </div>
    @endif

    <div class="space-y-2">
        @if ($title)
            <h3 class="text-lg font-semibold text-inherit {{ $titleClass }}">{{ $title }}</h3>
        @endif
        @if ($description)
            <p class="text-sm text-inherit/80">{{ $description }}</p>
        @endif
        {{ $slot }}
    </div>
</article>
