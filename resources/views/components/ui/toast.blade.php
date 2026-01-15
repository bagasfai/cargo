@php
    $sessionToasts = session('toasts');

    // fallback single toast
    if (!$sessionToasts && session('message')) {
        $sessionToasts = [[
            'type' => session('type', 'success'),
            'message' => session('message'),
        ]];
    }
@endphp

@if($sessionToasts)
<div
    x-data="toastStack({
        position: '{{ session('toast_position', 'top-right') }}',
        items: @js($sessionToasts),
        duration: 4000,
    })"
    x-cloak
    :class="positions[position]"
    class="fixed z-999999 flex flex-col gap-3 w-full max-w-sm"
>
    <template x-for="toast in toasts" :key="toast.id">
        <div
            x-show="toast.visible"
            @mouseenter="pause(toast)"
            @mouseleave="resume(toast)"
            x-transition:enter="transform ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-[-8px]"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transform ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-[-8px]"
            class="relative overflow-hidden rounded-xl border shadow-lg"
            :class="themes[toast.type]"
        >
            {{-- Content --}}
            <div class="flex items-start gap-3 px-4 py-3">
                <div class="pt-0.5 text-lg">
                    <span x-text="icons[toast.type]"></span>
                </div>

                <div class="flex-1 text-sm" x-text="toast.message"></div>

                <button
                    @click="close(toast)"
                    class="text-lg leading-none opacity-70 hover:opacity-100"
                >
                    ×
                </button>
            </div>

            {{-- Progress --}}
            <div class="h-1 w-full bg-black/10 dark:bg-white/10">
                <div
                    class="h-full transition-all duration-100 ease-linear"
                    :class="progressColors[toast.type]"
                    :style="`width: ${toast.progress}%`"
                ></div>
            </div>
        </div>
    </template>
</div>
@endif
