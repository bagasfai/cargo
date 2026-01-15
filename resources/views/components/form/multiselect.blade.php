@props([
    'label' => null,
    'name',
    'options' => [],
    'selected' => [],
])

<div class="space-y-1">
    @if($label)
        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ $label }}
        </label>
    @endif

    <select
        name="{{ $name }}[]"
        multiple
        {{ $attributes->merge([
            'class' => 'w-full rounded-lg border px-3 py-2 h-32 text-sm
                        bg-white dark:bg-gray-900
                        text-gray-900 dark:text-gray-100
                        border-gray-300 dark:border-gray-700'
        ]) }}
    >
        @foreach($options as $value => $text)
            <option value="{{ $value }}"
                @selected(in_array($value, old($name, $selected)))>
                {{ $text }}
            </option>
        @endforeach
    </select>

    <x-form.error :name="$name" />
</div>
