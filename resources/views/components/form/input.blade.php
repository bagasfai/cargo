@props([
    'label' => null,
    'type' => 'text',
    'name' => null, // ⬅️ OPTIONAL
    'value' => null,
    'placeholder' => '',
])

<div class="space-y-1">
    @if ($label)
        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ $label }}
        </label>
    @endif

    <input type="{{ $type }}" @if ($name) name="{{ $name }}" @endif
        value="{{ old($name ?? '', $value) }}" placeholder="{{ $placeholder }}"
        {{ $attributes->merge([
            'class' => 'w-full rounded-lg border px-3 py-2 text-sm
                                bg-white dark:bg-gray-900
                                text-gray-900 dark:text-gray-100
                                border-gray-300 dark:border-gray-700
                                focus:ring-2 focus:ring-blue-500 focus:outline-none',
        ]) }} />

    @if ($name)
        <x-form.error :name="$name" />
    @endif
</div>
