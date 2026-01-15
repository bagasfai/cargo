@props([
    'label' => null,
    'name' => 'files',
    'accept' => 'image/png,image/jpeg,image/webp,image/svg+xml',
    'multiple' => true,
    'preview' => true,
    'maxFiles' => null, // optional limit
])

<div class="space-y-2"
     x-data="{
        isDragging: false,
        files: [],

        handleDrop(e) {
            this.isDragging = false
            this.handleFiles(Array.from(e.dataTransfer.files))
        },

        handleFiles(selectedFiles) {
            const accepted = '{{ $accept }}'.split(',')
            let validFiles = selectedFiles.filter(f => accepted.includes(f.type))

            if (this.maxFiles && (this.files.length + validFiles.length) > this.maxFiles) {
                validFiles = validFiles.slice(0, this.maxFiles - this.files.length)
            }

            this.files.push(...validFiles)
        },

        removeFile(index) {
            this.files.splice(index, 1)
        }
     }"
     x-bind:max-files="{{ $maxFiles ?? 'null' }}"
>

    {{-- Label --}}
    @if($label)
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ $label }}
        </label>
    @endif

    {{-- Dropzone Card --}}
    <div
        @drop.prevent="handleDrop($event)"
        @dragover.prevent="isDragging = true"
        @dragleave.prevent="isDragging = false"
        @click="$refs.input.click()"
        :class="isDragging
            ? 'border-brand-500 bg-gray-100 dark:bg-gray-800'
            : 'border-gray-300 bg-gray-50 dark:border-gray-700 dark:bg-gray-900'"
        class="cursor-pointer transition rounded-xl border border-dashed p-7 lg:p-10"
    >

        {{-- Hidden input --}}
        <input
            x-ref="input"
            type="file"
            name="{{ $name }}{{ $multiple ? '[]' : '' }}"
            accept="{{ $accept }}"
            @change="handleFiles(Array.from($event.target.files)); $event.target.value = ''"
            {{ $multiple ? 'multiple' : '' }}
            class="hidden"
            @click.stop
        />

        {{-- Content --}}
        <div class="flex flex-col items-center text-center">

            {{-- Icon --}}
            <div class="mb-5 flex h-16 w-16 items-center justify-center rounded-full
                        bg-gray-200 text-gray-700
                        dark:bg-gray-800 dark:text-gray-400">
                📤
            </div>

            <h4 class="mb-2 font-semibold text-gray-800 dark:text-white/90">
                <span x-show="!isDragging">Drag & Drop Files Here</span>
                <span x-show="isDragging" x-cloak>Drop Files Here</span>
            </h4>

            <p class="mb-4 text-sm text-gray-700 dark:text-gray-400 max-w-xs">
                Drag & drop files here or click to browse
            </p>

            <span class="text-sm font-medium underline text-brand-500">
                Browse Files
            </span>
        </div>
    </div>

    {{-- Preview List --}}
    @if($preview)
        <div x-show="files.length > 0"
             x-cloak
             class="mt-4 rounded-xl border
                    border-gray-200 dark:border-gray-700
                    bg-white dark:bg-gray-900 p-4">

            <h5 class="mb-3 text-sm font-semibold text-gray-700 dark:text-gray-300">
                Selected Files
            </h5>

            <ul class="space-y-2">
                <template x-for="(file, index) in files" :key="index">
                    <li class="flex items-center justify-between rounded-lg
                               bg-gray-50 dark:bg-gray-800 px-3 py-2">

                        <div class="flex items-center gap-3">
                            <span class="text-sm text-gray-700 dark:text-gray-300"
                                  x-text="file.name"></span>
                            <span class="text-xs text-gray-500"
                                  x-text="(file.size / 1024).toFixed(1) + ' KB'"></span>
                        </div>

                        <button type="button"
                                @click.stop="removeFile(index)"
                                class="text-red-500 hover:text-red-700
                                       dark:text-red-400 dark:hover:text-red-300">
                            ✕
                        </button>
                    </li>
                </template>
            </ul>
        </div>
    @endif

    <x-form.error :name="$name" />
</div>
