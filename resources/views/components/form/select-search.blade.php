@props([
    'name' => null,
    'options' => [],
    'value' => null,
    'placeholder' => 'Select option',
    'multiple' => false,
    'label' => null,
])

@php
    $id = $attributes->get('id') ?? 'select-' . uniqid();

    // Normalisasi value agar support array/collection/string
    $selected = $multiple
        ? collect(old($name, $value ?? []))
            ->map(fn($v) => (string) $v)
            ->toArray()
        : (string) old($name, $value);
@endphp

<div x-data="{
    tomSelectInstance: null,
    initTomSelect() {
        if (this.tomSelectInstance) return;

        this.tomSelectInstance = new TomSelect(this.$refs.select, {
            dropdownParent: 'body',
            maxItems: {{ $multiple ? 'null' : '1' }},
            plugins: {{ $multiple ? "['remove_button']" : "['clear_button']" }},
            create: false,
            placeholder: '{{ $placeholder }}',
            searchField: ['text'],
            onChange: (value) => {
                this.$dispatch('select-change', {
                    name: '{{ $name }}',
                    value
                });
            }
        });
    }
}" x-init="$nextTick(() => initTomSelect())" class="relative w-full">
    @if ($label)
        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ $label }}
        </label>
    @endif
    <select x-ref="select" name="{{ $name }}{{ $multiple ? '[]' : '' }}" {{ $multiple ? 'multiple' : '' }}
        class="w-full">
        @unless ($multiple)
            <option value="">{{ $placeholder }}</option>
        @endunless

        @foreach ($options as $key => $label)
            <option value="{{ $key }}" @selected($multiple ? in_array((string) $key, $selected) : (string) $key === $selected)>
                {{ $label }}
            </option>
        @endforeach
    </select>
</div>
