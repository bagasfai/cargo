@extends('layouts.app')

@section('content')
    <div class="flex justify-between mb-6">
        <x-ui.heading level="h1">Blog Tags</x-ui.heading>
        <x-ui.button href="{{ route('blog-tags.create') }}" variant="primary">
            Create Tag
        </x-ui.button>
    </div>

    <x-table :columns="[
        [
            'label' => 'Name',
            'field' => 'name',
            'filter' => ['type' => 'text'],
        ],
        [
            'label' => 'Slug',
            'field' => 'slug',
            'filter' => ['type' => 'text'],
        ],
        [
            'label' => 'Created',
            'field' => 'created_at',
            'filter' => ['type' => 'date'],
            'format' => fn($row) => $row->created_at->format('d M Y'),
        ],
    ]" :rows="$tags" route="{{ route('blog-tags.index') }}" :actions="[
        'edit' => 'blog-tags.edit',
        'delete' => 'blog-tags.destroy',
    ]" />

@endsection
