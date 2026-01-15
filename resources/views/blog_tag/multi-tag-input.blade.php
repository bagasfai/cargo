<div x-data="{
    tags: @js(old('tags', [])),
    input: '',
    addTag() {
        let value = this.input.trim()
        if (!value) return

        value.split(',').forEach(tag => {
            tag = tag.trim()
            if (tag && !this.tags.includes(tag)) {
                this.tags.push(tag)
            }
        })

        this.input = ''
    },
    removeTag(index) {
        this.tags.splice(index, 1)
    }
}" class="space-y-2">
    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
        Tags
    </label>

    {{-- Tags container --}}
    <div
        class="flex flex-wrap items-center gap-2 rounded-lg border px-3 py-2
                bg-white dark:bg-gray-900
                border-gray-300 dark:border-gray-700
                focus-within:ring-2 focus-within:ring-blue-500">

        {{-- Existing tags --}}
        <template x-for="(tag, index) in tags" :key="index">
            <span
                class="inline-flex items-center gap-1 rounded-md
                       bg-blue-100 text-blue-700
                       dark:bg-blue-900/40 dark:text-blue-300
                       px-2 py-1 text-xs font-medium">
                <span x-text="tag"></span>
                <button type="button" @click="removeTag(index)" class="hover:text-red-500">
                    ×
                </button>
            </span>
        </template>

        {{-- Input --}}
        <input x-model="input" @keydown.enter.prevent="addTag()" @keydown.comma.prevent="addTag()" type="text"
            placeholder="Type tag and press Enter"
            class="flex-1 min-w-35 bg-transparent
                   text-sm text-gray-900 dark:text-gray-100
                   focus:outline-none" />
    </div>

    <p class="text-xs text-gray-500 dark:text-gray-400">
        Press <b>Enter</b> or <b>,</b> to add multiple tags
    </p>

    {{-- Hidden inputs --}}
    <template x-for="tag in tags">
        <input type="hidden" name="tags[]" :value="tag">
    </template>

    <x-form.error name="tags" />
</div>
