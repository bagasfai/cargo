@extends('layouts.app')

@section('content')
    <div class="flex justify-between mb-6">
        <x-ui.heading level="h1">Blog Posts</x-ui.heading>
        <x-ui.button href="{{ route('blogs.create') }}" variant="primary">
            Create Blog
        </x-ui.button>
    </div>

    <x-table :columns="[
        ['label' => 'Title', 'field' => 'title'],
        ['label' => 'Author', 'field' => 'author_name'],
        ['label' => 'Status', 'field' => 'status'],
        ['label' => 'Created', 'field' => 'created_at'],
    ]" :rows="$blogs" route="{{ route('blogs.index') }}" :actions="[
        'view' => 'blogs.show',
        'edit' => 'blogs.edit',
        'delete' => 'blogs.destroy',
    ]" />

    {{ $blogs->links() }}
@endsection
