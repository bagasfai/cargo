@props([
    'label',
    'name',
    'checked' => false,
])

<label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
    <input type="checkbox"
           name="{{ $name }}"
           value="1"
           @checked(old($name, $checked))
           class="rounded border-gray-300 dark:border-gray-700
                  text-blue-600 focus:ring-blue-500">
    {{ $label }}
</label>
