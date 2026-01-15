@props([
    'level' => 'h1',
])

@php
$tag = $level;
$baseClass = match($level) {
    'h1' => 'text-2xl font-bold',
    'h2' => 'text-xl font-semibold',
    'h3' => 'text-lg font-semibold',
    default => 'text-base font-medium',
};
@endphp

<{{ $tag }}
    {{ $attributes->merge([
        'class' => "$baseClass text-slate-900 dark:text-slate-100"
    ]) }}
>
    {{ $slot }}
</{{ $tag }}>
