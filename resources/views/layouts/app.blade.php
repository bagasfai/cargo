<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="index, follow">

    <title>{{ $title ?? 'Dashboard' }} | Cargo</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Theme Store -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('theme', {
                init() {
                    const savedTheme = localStorage.getItem('theme');
                    const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' :
                        'light';
                    this.theme = savedTheme || systemTheme;
                    this.updateTheme();
                },
                theme: 'light',
                toggle() {
                    this.theme = this.theme === 'light' ? 'dark' : 'light';
                    localStorage.setItem('theme', this.theme);
                    this.updateTheme();
                },
                updateTheme() {
                    const html = document.documentElement;
                    const body = document.body;
                    if (this.theme === 'dark') {
                        html.classList.add('dark');
                        body.classList.add('dark', 'bg-gray-900');
                    } else {
                        html.classList.remove('dark');
                        body.classList.remove('dark', 'bg-gray-900');
                    }
                }
            });

            Alpine.store('sidebar', {
                // Initialize based on screen size
                isExpanded: window.innerWidth >= 1280, // true for desktop, false for mobile
                isMobileOpen: false,
                isHovered: false,

                toggleExpanded() {
                    this.isExpanded = !this.isExpanded;
                    // When toggling desktop sidebar, ensure mobile menu is closed
                    this.isMobileOpen = false;
                },

                toggleMobileOpen() {
                    this.isMobileOpen = !this.isMobileOpen;
                    // Don't modify isExpanded when toggling mobile menu
                },

                setMobileOpen(val) {
                    this.isMobileOpen = val;
                },

                setHovered(val) {
                    // Only allow hover effects on desktop when sidebar is collapsed
                    if (window.innerWidth >= 1280 && !this.isExpanded) {
                        this.isHovered = val;
                    }
                }
            });
        });
    </script>

    <!-- Apply dark mode immediately to prevent flash -->
    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');
            const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            const theme = savedTheme || systemTheme;
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    {!! SEO::generate() !!}

    @stack('styles')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">

</head>

<body x-data="{ 'loaded': true }" x-init="$store.sidebar.isExpanded = window.innerWidth >= 1280;
const checkMobile = () => {
    if (window.innerWidth < 1280) {
        $store.sidebar.setMobileOpen(false);
        $store.sidebar.isExpanded = false;
    } else {
        $store.sidebar.isMobileOpen = false;
        $store.sidebar.isExpanded = true;
    }
};
window.addEventListener('resize', checkMobile);">

    {{-- preloader --}}
    <x-common.preloader />
    {{-- preloader end --}}

    <div class="min-h-screen xl:flex">
        @include('layouts.backdrop')
        @include('layouts.sidebar')

        <div class="flex-1 transition-all duration-300 ease-in-out"
            :class="{
                'xl:ml-72.5': $store.sidebar.isExpanded || $store.sidebar.isHovered,
                'xl:ml-22.5': !$store.sidebar.isExpanded && !$store.sidebar.isHovered,
                'ml-0': $store.sidebar.isMobileOpen
            }">
            <!-- app header start -->
            @include('layouts.app-header')
            <!-- app header end -->
            <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
                @yield('content')
            </div>
        </div>
        <x-ui.toast />
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
@stack('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('toastStack', ({
            items,
            duration,
            position
        }) => ({
            toasts: [],
            duration,
            position,

            positions: {
                'top-right': 'top-5 right-5 items-end',
                'top-left': 'top-5 left-5 items-start',
                'bottom-right': 'bottom-5 right-5 items-end',
                'bottom-left': 'bottom-5 left-5 items-start',
            },

            icons: {
                success: '✅',
                error: '❌',
                warning: '⚠️',
                info: 'ℹ️',
            },

            themes: {
                success: 'bg-green-50 text-green-800 border-green-200 dark:bg-green-900/40 dark:text-green-200 dark:border-green-800',
                error: 'bg-red-50 text-red-800 border-red-200 dark:bg-red-900/40 dark:text-red-200 dark:border-red-800',
                warning: 'bg-yellow-50 text-yellow-800 border-yellow-200 dark:bg-yellow-900/40 dark:text-yellow-200 dark:border-yellow-800',
                info: 'bg-blue-50 text-blue-800 border-blue-200 dark:bg-blue-900/40 dark:text-blue-200 dark:border-blue-800',
            },

            progressColors: {
                success: 'bg-green-500',
                error: 'bg-red-500',
                warning: 'bg-yellow-500',
                info: 'bg-blue-500',
            },

            init() {
                items.forEach(item => this.add(item))
            },

            add(item) {
                const toast = {
                    id: Date.now() + Math.random(),
                    type: item.type || 'info',
                    message: item.message,
                    visible: true,
                    progress: 100,
                    interval: null,
                    paused: false,
                }

                this.toasts.push(toast)
                this.startTimer(toast)
            },

            startTimer(toast) {
                const step = 100 / (this.duration / 100)

                toast.interval = setInterval(() => {
                    const idx = this.toasts.findIndex(t => t.id === toast.id)
                    if (idx === -1) {
                        clearInterval(toast.interval)
                        return
                    }

                    const current = this.toasts[idx]
                    if (current.paused) return

                    current.progress = Math.max(0, current.progress - step)
                    this.toasts = [...this.toasts]

                    if (current.progress <= 0) {
                        this.close(current)
                    }
                }, 100)
            },

            pause(toast) {
                toast.paused = true
                this.toasts = [...this.toasts]
            },

            resume(toast) {
                toast.paused = false
                this.toasts = [...this.toasts]
            },

            close(toast) {
                toast.visible = false
                clearInterval(toast.interval)
                this.toasts = [...this.toasts]

                setTimeout(() => {
                    this.toasts = this.toasts.filter(t => t.id !== toast.id)
                }, 200)
            },
        }))
    })
</script>

</html>
