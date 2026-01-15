<th class="px-4 py-3 text-left text-sm font-semibold
           text-gray-700 dark:text-gray-300">

    @if ($field)
        <a href="{{ $route }}?sort={{ $field }}&direction={{ request('direction') === 'asc' ? 'desc' : 'asc' }}"
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
