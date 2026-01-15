<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Cargo</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {!! SEO::generate() !!}

</head>

<body>
    {{-- preloader --}}
    <x-common.preloader />
    {{-- preloader end --}}

    <div class="min-h-screen w-screen xl:flex bg-gray-100">
        <div class="flex-1">
            <img src="{{ asset('images/logo-header.svg') }}" alt="" class="h-8 w-8">
        </div>
    </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

</html>
