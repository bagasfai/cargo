<?php

namespace App\Http\Controllers;

use App\Helpers\SeoManager;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Artesaos\SEOTools\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('author')
            ->latest()
            ->paginate(10);

        return view('blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('blog.create', [
            'categories' => BlogCategory::all(),
            'tags' => BlogTag::all(),
        ]);
    }

    public function store(BlogRequest $request)
    {
        DB::transaction(function () use ($request) {

            $data = $request->validated();
            $data['author_id'] = Auth::id();

            // SEO fallback
            $data['seo_title'] ??= $data['title'];
            $data['seo_description'] ??= $data['excerpt'];

            $blog = Blog::create($data);

            // Categories
            $blog->categories()->sync($request->categories);

            // Tags
            $tags = collect($request->tags)
                ->map(fn($tag) => trim($tag))
                ->filter()
                ->map(
                    fn($tag) =>
                    BlogTag::firstOrCreate(['name' => $tag])
                );

            $blog->tags()->sync($tags->pluck('id'));
        });

        return redirect()
            ->route('blogs.index')
            ->with('success', 'Blog berhasil dibuat');
    }

    public function edit(Blog $blog)
    {
        return view('blog.edit', [
            'blog' => $blog->load('categories', 'tags'),
            'categories' => BlogCategory::all(),
            'tags' => BlogTag::all(),
        ]);
    }

    public function update(BlogRequest $request, Blog $blog)
    {
        DB::transaction(function () use ($request, $blog) {

            $data = $request->validated();

            // Jangan ubah slug kalau sudah publish
            if ($blog->status === 'published') {
                unset($data['slug']);
            }

            $data['seo_title'] ??= $data['title'];
            $data['seo_description'] ??= $data['excerpt'];

            $blog->update($data);

            $blog->categories()->sync($request->categories);

            $tags = collect(explode(',', $request->tags))
                ->map(fn($tag) => trim($tag))
                ->filter()
                ->map(
                    fn($tag) =>
                    BlogTag::firstOrCreate(['name' => $tag])
                );

            $blog->tags()->sync($tags->pluck('id'));
        });

        return back()->with('success', 'Blog berhasil diperbarui');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return back()->with('success', 'Blog berhasil dihapus');
    }

    public function show(Blog $blog)
    {
        // SeoManager::forBlog($blog);
        return view('blog.show', compact('blog'));
    }

    public function category(string $slug)
    {
        $category = BlogCategory::where('slug', $slug)->firstOrFail();

        SEOTools::setTitle($category->name . ' | Blog Cargo');
        SEOTools::setDescription(
            $category->description ?: 'Artikel kategori ' . $category->name
        );

        $blogs = $category->blogs()
            ->published()
            ->paginate(10);

        return view('blog.category', compact('category', 'blogs'));
    }

    public function tag(string $slug)
    {
        $tag = BlogTag::where('slug', $slug)->firstOrFail();

        SEOTools::setTitle('Tag: ' . $tag->name . ' | Blog Cargo');
        SEOTools::setDescription(
            'Artikel dengan topik ' . $tag->name . ' seputar jasa cargo dan ekspedisi.'
        );

        SEOTools::metatags()->addMeta(
            'robots',
            'noindex, follow'
        );

        $blogs = $tag->blogs()
            ->published()
            ->latest('published_at')
            ->paginate(10);

        return view('blog.tag', compact('tag', 'blogs'));
    }
}
