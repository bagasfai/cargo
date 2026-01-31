@extends('layouts.app')

@section('content')
    <div class="flex justify-between mb-6">
        <x-ui.heading level="h1">Category Blog</x-ui.heading>
        <x-ui.button href="{{ route('blog-categories.create') }}" variant="primary">
            Create Category Blog
        </x-ui.button>
    </div>

    <x-table :columns="[
        [
            'label' => 'Name',
            'field' => 'name',
            'filter' => ['type' => 'text'],
        ],
        [
            'label' => 'Description',
            'field' => 'description',
            'filter' => ['type' => 'text'],
        ],
        [
            'label' => 'Created',
            'field' => 'created_at',
            'filter' => ['type' => 'date'],
            'format' => fn($row) => $row->created_at->format('d M Y'),
        ],
    ]" :rows="$categories" route="{{ route('blog-categories.index') }}" :actions="[
        'edit' => 'blog-categories.edit',
        'delete' => 'blog-categories.destroy',
    ]" />

@endsection
