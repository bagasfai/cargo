@php
$base = 'inline-flex items-center justify-center gap-2 font-medium rounded-lg transition-all
         focus:outline-none focus:ring-2 focus:ring-offset-2
         disabled:opacity-60 disabled:cursor-not-allowed';

$sizes = [
    'sm' => 'px-3 py-1.5 text-sm',
    'md' => 'px-4 py-2 text-sm',
    'lg' => 'px-5 py-2.5 text-base',
];

$variants = [
    'primary' => 'bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500
                  dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-400',

    'secondary' => 'bg-gray-200 text-gray-800 hover:bg-gray-300 focus:ring-gray-400
                    dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-gray-600',

    'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500
                 dark:bg-red-500 dark:hover:bg-red-600',

    'outline' => 'border border-gray-300 text-gray-700 hover:bg-gray-100
                  dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-700',
];

$classes = implode(' ', [
    $base,
    $sizes[$size] ?? $sizes['md'],
    $variants[$variant] ?? $variants['primary'],
    $loading ? 'pointer-events-none' : '',
]);
@endphp

{{-- Link --}}
@if($isLink())
<a
    href="{{ $href }}"
    {{ $attributes->merge(['class' => $classes]) }}
>
    @include('components.ui.partials.button-content')
</a>

{{-- Button --}}
@else
<button
    type="{{ $type }}"
    @disabled($disabled || $loading)
    {{ $attributes->merge(['class' => $classes]) }}
>
    @include('components.ui.partials.button-content')
</button>
@endif
