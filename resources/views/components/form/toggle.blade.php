@props([
    'label',
    'name',
    'checked' => false,
])

<div x-data="{ on: {{ old($name, $checked) ? 'true' : 'false' }} }"
     class="flex items-center justify-between">

    <span class="text-sm text-gray-700 dark:text-gray-300">
        {{ $label }}
    </span>

    <button type="button"
            @click="on = !on"
            :class="on ? 'bg-blue-600' : 'bg-gray-300 dark:bg-gray-700'"
            class="relative inline-flex h-6 w-11 rounded-full transition">
        <span
            :class="on ? 'translate-x-6' : 'translate-x-1'"
            class="inline-block h-4 w-4 bg-white rounded-full transform transition mt-1">
        </span>
    </button>

    <input type="hidden" name="{{ $name }}" :value="on ? 1 : 0">
</div>
