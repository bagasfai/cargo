<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Services\BlogService;
use Artesaos\SEOTools\SEOTools;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function __construct(
        private readonly BlogService $blogService,
    ) {}

    public function index(): View
    {
        $blogs = Blog::with('author')
            ->latest()
            ->paginate(10);

        return view('blog.index', compact('blogs'));
    }

    public function create(): View
    {
        return view('blog.create', [
            'categories' => BlogCategory::all(),
            'tags' => BlogTag::all(),
        ]);
    }

    public function store(BlogRequest $request): RedirectResponse
    {
        $this->blogService->store(
            data: $request->validated(),
            authorId: Auth::id(),
            featuredImage: $request->file('featured_image'),
        );

        return redirect()
            ->route('blogs.index')
            ->with('success', 'Blog berhasil dibuat');
    }

    public function edit(Blog $blog): View
    {
        return view('blog.edit', [
            'blog' => $blog->load('categories', 'tags'),
            'categories' => BlogCategory::all(),
            'tags' => BlogTag::all(),
        ]);
    }

    public function update(BlogRequest $request, Blog $blog): RedirectResponse
    {
        $this->blogService->update(
            blog: $blog,
            data: $request->validated(),
            featuredImage: $request->file('featured_image'),
        );

        return back()->with('success', 'Blog berhasil diperbarui');
    }

    public function destroy(Blog $blog): RedirectResponse
    {
        $blog->delete();

        return back()->with('success', 'Blog berhasil dihapus');
    }

    public function show(Blog $blog): View
    {
        return view('blog.show', compact('blog'));
    }

    public function category(string $slug): View
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

    public function tag(string $slug): View
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
