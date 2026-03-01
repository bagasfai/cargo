@extends('layouts.app')
@section('title', 'Edit Blog')
@section('content')
    {{-- Ubah x-data disini --}}
    <div class="max-w-5xl mx-auto space-y-6" x-data="blogForm()">

        {{-- Header --}}
        <div class="flex justify-between items-center">
            <x-ui.heading level="h1">Edit Blog</x-ui.heading>
            <a href="{{ route('blogs.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">
                ← Back to Blog
            </a>
        </div>

        <form action="{{ route('blogs.update', $blog) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- LEFT: Content --}}
                <div class="lg:col-span-2 space-y-6">
                    {{-- Tambahkan x-model="form.title" --}}
                    <x-form.input name="title" label="Title" placeholder="Enter blog title" value="{{ $blog->title }}" x-model="form.title" />

                    <x-form.input name="slug" label="Slug (SEO URL)" placeholder="auto-generated-from-title" value="{{ $blog->slug }}" />

                    <div>
                        <x-form.editor :value="$blog->content" />
                        {{-- x-ref sudah ada, aman --}}
                        <input type="hidden" name="content" x-ref="content" value="{{ $blog->content }}">
                    </div>

                    <x-form.textarea name="excerpt" label="Excerpt" placeholder="Short description">{{ $blog->excerpt }}</x-form.textarea>
                </div>

                {{-- RIGHT: Meta --}}
                <div class="space-y-6">
                    <x-form.select-search name="status" label="Status" :options="['draft' => 'Draft', 'published' => 'Published']" :selected="$blog->status" />
                    <x-form.select-search name="categories" label="Category" :options="$categories->pluck('name', 'id')->toArray()" :selected="$blog->categories->pluck('id')->toArray()" multiple />
                    <x-form.select-search name="tags" label="Tags" :options="$tags->pluck('name', 'name')->toArray()" :selected="$blog->tags->pluck('name')->toArray()" multiple />

                    <x-form.file name="featured_image" label="Featured Image"
                        @file-selected="handleFileUpload($event.detail)" />
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-800">
                <a href="{{ route('blogs.index') }}"
                    class="px-4 py-2 rounded-lg border text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-700">
                    Cancel
                </a>

                {{-- TOMBOL PREVIEW BARU --}}
                <button type="button" @click="openPreview()"
                    class="px-4 py-2 rounded-lg border border-blue-600 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition">
                    👁️ Preview
                </button>

                <x-ui.button type="submit">
                    Update
                </x-ui.button>
            </div>
        </form>

        {{-- ======================== --}}
        {{-- MODAL PREVIEW AREA       --}}
        {{-- ======================== --}}
        <div x-show="showPreview" style="display: none" class="fixed inset-0 z-9999999 overflow-y-auto"
            aria-labelledby="modal-title" role="dialog" aria-modal="true">

            {{-- Backdrop --}}
            <div x-show="showPreview" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity backdrop-blur-sm"></div>

            {{-- Modal Panel --}}
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div x-show="showPreview" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-900 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl border border-gray-200 dark:border-gray-700">

                    {{-- Modal Header --}}
                    <div
                        class="bg-gray-50 dark:bg-gray-800 px-4 py-3 sm:px-6 flex justify-between items-center border-b dark:border-gray-700">
                        <h3 class="text-lg font-semibold leading-6 text-gray-900 dark:text-gray-100">
                            Blog Post Preview
                        </h3>
                        <button @click="showPreview = false"
                            class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                            <span class="sr-only">Close</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    {{-- Modal Body (The Preview Content) --}}
                    <div class="px-4 py-6 sm:px-6 max-h-[80vh] overflow-y-auto">
                        <article class="prose dark:prose-invert max-w-none mx-auto">

                            {{-- Preview Gambar --}}
                            <template x-if="form.image">
                                <img :src="form.image" class="w-full h-64 object-cover rounded-xl mb-6 shadow-md"
                                    alt="Featured Image Preview">
                            </template>
                            <template x-if="!form.image">
                                <div
                                    class="w-full h-64 bg-gray-100 dark:bg-gray-800 rounded-xl mb-6 flex items-center justify-center text-gray-400">
                                    No Image Selected
                                </div>
                            </template>

                            {{-- Preview Judul --}}
                            <h1 class="text-3xl md:text-4xl font-bold mb-4" x-text="form.title || 'Untitled Blog Post'">
                            </h1>

                            {{-- Preview Meta --}}
                            <div
                                class="flex items-center gap-4 text-sm text-gray-500 dark:text-gray-400 mb-8 pb-8 border-b dark:border-gray-800">
                                <span>{{ $blog->author->name ?? 'Author Name' }}</span>
                                <span>&bull;</span>
                                <span>{{ $blog->published_at ? $blog->published_at->format('d M Y') : now()->format('d M Y') }}</span>
                            </div>

                            {{-- Preview Konten (HTML dari Quill) --}}
                            <div class="quill-content" x-html="form.content || '<p>Start writing your content...</p>'">
                            </div>
                        </article>
                    </div>

                    {{-- Modal Footer --}}
                    <div
                        class="bg-gray-50 dark:bg-gray-800 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 border-t dark:border-gray-700">
                        <button type="button" @click="showPreview = false"
                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white dark:bg-gray-700 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-100 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 sm:mt-0 sm:w-auto">
                            Close Preview
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('blogForm', () => ({
                // State untuk Preview
                showPreview: false,
                form: {
                    title: '{{ $blog->title }}',
                    content: `{!! $blog->content !!}`,
                    image: null, // Untuk menampung URL gambar sementara
                    imageName: ''
                },
                quill: null,

                init() {
                    // Setup Quill
                    this.quill = new Quill('#editor', {
                        theme: 'snow',
                        modules: {
                            toolbar: '#toolbar-container',
                            clipboard: {
                                matchVisual: false
                            }
                        }
                    });

                    // Set existing content
                    this.quill.root.innerHTML = this.form.content;

                    // Sync Quill ke Alpine State & Input Hidden
                    this.quill.on('text-change', () => {
                        let html = this.quill.root.innerHTML;
                        this.form.content = html;
                        this.$refs.content.value = html; // Update hidden input untuk submit
                    });
                },

                // Logic untuk menampilkan gambar yang diupload di preview
                handleFileUpload(file) {
                    // Parameter sekarang adalah 'file', bukan 'event'
                    if (file) {
                        this.form.imageName = file.name;

                        // Logic baca file untuk preview Modal
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.form.image = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    } else {
                        // Handle jika user klik tombol 'Remove' (file null)
                        this.form.image = null;
                        this.form.imageName = '';
                    }
                },

                openPreview() {
                    this.showPreview = true;
                }
            }))
        })
    </script>
@endpush
