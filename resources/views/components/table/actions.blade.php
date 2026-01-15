@props([
    'row',
    'actions' => [],
])

<div class="flex gap-2">
    @if(isset($actions['view']))
        <x-ui.button
            href="{{ route($actions['view'], $row) }}"
            size="xs"
            variant="info">
            View
        </x-ui.button>
    @endif

    @if(isset($actions['edit']))
        <x-ui.button
            href="{{ route($actions['edit'], $row) }}"
            size="xs"
            variant="warning">
            Edit
        </x-ui.button>
    @endif

    @if(isset($actions['delete']))
        <form action="{{ route($actions['delete'], $row) }}"
              method="POST"
              onsubmit="return confirm('Delete this data?')">
            @csrf
            @method('DELETE')

            <x-ui.button
                type="submit"
                size="xs"
                variant="danger">
                Delete
            </x-ui.button>
        </form>
    @endif
</div>
