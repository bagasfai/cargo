@props(['class', 'columns', 'rows', 'route', 'actions' => null])

<div x-data="{
    filters: @js(request()->all()),
    apply() {
        const url = new URL('{{ $route }}', window.location.origin);

        Object.entries(this.filters).forEach(([key, value]) => {
            if (value === null || value === '' || (Array.isArray(value) && value.length === 0)) {
                url.searchParams.delete(key);
            } else if (Array.isArray(value)) {
                url.searchParams.set(key, value.join(','));
            } else {
                url.searchParams.set(key, value);
            }
        });

        window.location = url.toString();
    }
}" @select-change.window="
    filters[$event.detail.name] = $event.detail.value;
    apply();
" class="space-y-4 {{ $class ?? '' }}">

    {{-- Table --}}
    <div class="overflow-x-auto rounded-xl border bg-white dark:bg-gray-900 dark:border-gray-800">

        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">

            <thead class="bg-gray-50 dark:bg-gray-800">

                {{-- HEADER ROW --}}
                <tr>
                    @foreach ($columns as $column)
                        <x-table.th :label="$column['label']" :field="$column['field'] ?? null" :route="$route" />
                    @endforeach

                    @if ($actions)
                        <th class="px-4 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Action
                        </th>
                    @endif
                </tr>

                {{-- FILTER ROW --}}
                <tr class="bg-gray-100 dark:bg-gray-900">
                    @if (isset($column['filter']))
                        @foreach ($columns as $column)
                            <th class="p-2">
                                <x-table.filter :column="$column" />
                            </th>
                        @endforeach
                    @endif

                    @if ($actions)
                        <th></th>
                    @endif
                </tr>

            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                @forelse ($rows as $row)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">

                        @foreach ($columns as $column)
                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                @if (isset($column['format']) && is_callable($column['format']))
                                    {{ $column['format']($row) }}
                                @else
                                    {{ data_get($row, $column['field']) }}
                                @endif
                            </td>
                        @endforeach

                        @if ($actions)
                            <td class="px-4 py-3">
                                <x-table.actions :row="$row" :actions="$actions" />
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($columns) + ($actions ? 1 : 0) }}"
                            class="py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                            No data found
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    {{-- Pagination --}}
    <div class="dark:text-gray-300">
        {{ $rows->links() }}
    </div>
</div>
