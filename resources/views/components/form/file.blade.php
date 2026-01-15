@props([
    'label' => null,
    'name',
    'accept' => 'image/*',
    'preview' => true,
    'current' => null,
])

<div {{ $attributes->merge(['class' => 'space-y-2']) }} x-data="{
    fileName: '{{ $current ? basename($current) : '' }}',
    previewUrl: '{{ $current }}',

    handleFile(e) {
        const file = e.target.files[0]
        if (!file) return

        this.fileName = file.name

        // Logic Preview Lokal (Child)
        if (file.type.startsWith('image/')) {
            this.previewUrl = URL.createObjectURL(file)
        } else {
            this.previewUrl = null
        }

        // PENTING: Kirim data file ke Parent Component
        this.$dispatch('file-selected', file)
    },

    clear() {
        this.fileName = ''
        this.previewUrl = null
        this.$refs.input.value = ''

        // Beritahu Parent bahwa file dihapus
        this.$dispatch('file-selected', null)
    }
}">
    {{-- Bagian tampilan sama persis, tidak perlu diubah --}}
    @if ($label)
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ $label }}
        </label>
    @endif

    <div class="rounded-xl border bg-white dark:bg-gray-900 border-gray-300 dark:border-gray-700 p-4 space-y-4">
        @if ($preview)
            <template x-if="previewUrl">
                <div>
                    <img :src="previewUrl"
                        class="h-48 w-full object-cover rounded-lg border border-gray-200 dark:border-gray-700">
                </div>
            </template>
        @endif

        <div class="flex items-center gap-3">
            <div class="h-10 w-10 flex items-center justify-center rounded-lg bg-gray-100 dark:bg-gray-800">
                📁
            </div>
            <div class="text-sm">
                <p class="text-gray-800 dark:text-gray-200" x-text="fileName || 'No file selected'"></p>
                <p class="text-xs text-gray-500">{{ $accept }}</p>
            </div>
        </div>

        <div class="flex gap-3">
            <label
                class="inline-flex items-center px-4 py-2 text-sm rounded-lg border cursor-pointer border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                Change file
                <input type="file" x-ref="input" name="{{ $name }}" accept="{{ $accept }}"
                    class="hidden" @change="handleFile">
            </label>
            <button type="button" @click="clear" x-show="fileName"
                class="px-4 py-2 text-sm rounded-lg border border-red-300 dark:border-red-500 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
                Remove
            </button>
        </div>
    </div>
    <x-form.error :name="$name" />
</div>
