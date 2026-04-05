<?php

namespace App\Http\Controllers;

use App\Helpers\SeoManager;
use App\Models\Blog;
use Illuminate\View\View;

class PublicBlogController extends Controller
{
    /**
     * Display a single published blog post with full SEO meta tags.
     */
    public function show(Blog $blog): View
    {
        // Ensure only published posts are viewable publicly
        abort_unless($blog->isPublished(), 404);

        // Eager-load relationships to prevent N+1
        $blog->load(['categories', 'tags', 'author', 'media']);

        // Inject SEO meta tags via our centralized helper
        // SeoManager::forBlog($blog);

        return view('public.blog.show', compact('blog'));
    }
}
