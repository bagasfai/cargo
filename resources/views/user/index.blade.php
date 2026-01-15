@extends('layouts.app')

@section('content')
    <div class="flex justify-between mb-6">
        <x-ui.heading level="h1">Users</x-ui.heading>
        <x-ui.button href="{{ route('users.create') }}" variant="primary">
            Create Users
        </x-ui.button>
    </div>

    <x-table :columns="[
        [
            'label' => 'Name',
            'field' => 'name',
            'filter' => ['type' => 'text'],
        ],
        [
            'label' => 'Email',
            'field' => 'email',
            'filter' => ['type' => 'text'],
        ],
        [
            'label' => 'Roles',
            'field' => 'roles',
            'format' => fn($row) => $row->roles->pluck('name')->implode(', '),
            'filter' => [
                'type' => 'select',
                'options' => $roles->pluck('name', 'name')->toArray(),
            ],
        ],
        [
            'label' => 'Created At',
            'field' => 'created_at',
            'filter' => ['type' => 'date'],
        ],
    ]" :rows="$users" route="{{ route('users.index') }}" :actions="[
        'edit' => 'users.edit',
        'delete' => 'users.destroy',
    ]" />


    {{ $users->links() }}
@endsection
