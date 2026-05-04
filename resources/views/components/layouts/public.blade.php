@props(['title' => 'Cargo'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, follow">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>[x-cloak]{display:none;}</style>

    {!! SEO::generate() !!}

    @stack('styles')
</head>

<body class="min-h-screen bg-white text-gray-900 antialiased">
    <x-common.preloader />
    <div class="flex min-h-screen flex-col">
        {{ $slot }}
    </div>
    <x-whatsapp-popup />

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    @stack('scripts')
</body>

</html>
