@props(['label', 'field' => null, 'route' => null, 'fragment' => null])

@php
    $nextDirection = request('sort') === $field && request('direction') === 'asc' ? 'desc' : 'asc';
    $sortUrl = $field ? request()->fullUrlWithQuery(['sort' => $field, 'direction' => $nextDirection, 'page' => 1]) : null;

    if ($sortUrl && $fragment) {
        $sortUrl .= '#'.$fragment;
    }
@endphp

<th class="px-4 py-3 text-left text-sm font-semibold
           text-gray-700 dark:text-gray-300">

    @if ($field)
        <a href="{{ $sortUrl }}"
            class="flex items-center gap-1 hover:underline
                  dark:hover:text-white">
            {{ $label }}

            @if (request('sort') === $field)
                <span class="text-xs">
                    {{ request('direction') === 'asc' ? '↑' : '↓' }}
                </span>
            @endif
        </a>
    @else
        {{ $label }}
    @endif
</th>
