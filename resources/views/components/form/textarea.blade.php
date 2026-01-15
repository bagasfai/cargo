@props([
    'label' => null,
    'name',
    'rows' => 4,
    'value' => null,
])

<div class="space-y-1">
    @if($label)
        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ $label }}
        </label>
    @endif

    <textarea
        name="{{ $name }}"
        rows="{{ $rows }}"
        {{ $attributes->merge([
            'class' => 'w-full rounded-lg border px-3 py-2 text-sm
                        bg-white dark:bg-gray-900
                        text-gray-900 dark:text-gray-100
                        border-gray-300 dark:border-gray-700
                        focus:ring-2 focus:ring-blue-500 focus:outline-none'
        ]) }}
    >{{ old($name, $value) }}</textarea>

    <x-form.error :name="$name" />
</div>
