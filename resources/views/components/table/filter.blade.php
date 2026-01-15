@props(['column'])

@php
    $name = $column['field'];
    $filter = $column['filter'];
@endphp

@if (in_array($filter['type'], ['text', 'number']))
    <x-form.input :type="$filter['type']" :value="request($name)" x-model="filters['{{ $name }}']" @change="apply" />
@elseif ($filter['type'] === 'select')
    <select x-model="filters['{{ $name }}']" @change="apply" {{ $filter['multiple'] ?? false ? 'multiple' : '' }}
        class="w-full rounded-lg border py-2 text-sm
               bg-white dark:bg-gray-900
               text-gray-900 dark:text-gray-100
               border-gray-300 dark:border-gray-700
               focus:ring-2 focus:ring-blue-500 focus:outline-none">
        @unless ($filter['multiple'] ?? false)
            <option value="">All</option>
        @endunless

        @foreach ($filter['options'] as $key => $label)
            <option value="{{ $key }}">{{ $label }}</option>
        @endforeach
    </select>
@elseif ($filter['type'] === 'date')
    <div
        @date-change="
            filters['{{ $name }}'] = $event.detail.dateStr;
            apply();
        ">
        <x-form.date-picker mode="single" :name="$name" :defaultDate="request($name)" />
    </div>

    {{-- DATE RANGE --}}
@elseif ($filter['type'] === 'date-range')
    <div class="space-y-1"
        @date-change="
            const dates = $event.detail.dateStr.split(' to ');
            filters['{{ $name }}_from'] = dates[0] ?? null;
            filters['{{ $name }}_to'] = dates[1] ?? null;
            apply();
        ">
        <x-form.date-picker mode="range" :name="$name . '_range'" :defaultDate="request()->only([$name . '_from', $name . '_to'])" placeholder="Date range" />
    </div>
@endif
