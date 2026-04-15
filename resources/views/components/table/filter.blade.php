@props(['column'])

@php
    $name = $column['filter_key'] ?? $column['field'];
    $filter = $column['filter'];
@endphp

@if (in_array($filter['type'], ['text', 'number']))
    <x-form.input :type="$filter['type']" :value="request($name)" x-model="filters['{{ $name }}']" @change="apply" />
@elseif ($filter['type'] === 'select')
    <x-form.select-search 
        :name="$column['filter_key'] ?? $column['field']"
        :options="$filter['options']" 
        :value="request($column['filter_key'] ?? $column['field'])"
    />
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
