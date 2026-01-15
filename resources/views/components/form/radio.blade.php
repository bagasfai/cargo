@props([
    'label' => null,
    'name',
    'options' => [],
    'checked' => null,
])

<div class="space-y-2">
    @if($label)
        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ $label }}
        </p>
    @endif

    @foreach($options as $value => $text)
        <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
            <input type="radio"
                   name="{{ $name }}"
                   value="{{ $value }}"
                   @checked(old($name, $checked) == $value)
                   class="text-blue-600 focus:ring-blue-500">
            {{ $text }}
        </label>
    @endforeach

    <x-form.error :name="$name" />
</div>
