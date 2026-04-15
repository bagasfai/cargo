<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogTagRequest;
use App\Models\BlogTag;
use Illuminate\Http\Request;

class BlogTagController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Blog Tags';

        $tags = BlogTag::query()
            ->when($request->name, fn($q) => $q->where('name', 'like', "%{$request->name}%"))
            ->when($request->slug, fn($q) => $q->where('slug', 'like', "%{$request->slug}%"))
            ->when($request->created_at, fn($q) => $q->whereDate('created_at', $request->created_at))
            ->when($request->sort, function ($q) use ($request) {
                $q->orderBy($request->sort, $request->direction);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('blog_tag.index', compact('tags', 'title'));
    }

    public function create()
    {
        $title = 'Create Blog Tag';
        return view('blog_tag.create', compact('title'));
    }

    public function store(BlogTagRequest $request)
    {
        foreach ($request->validated()['tags'] as $tagName) {
            $existingTag = BlogTag::where('name', $tagName)->first();
            if ($existingTag) {
                continue;
            }
            BlogTag::create(['name' => $tagName]);
        }

        return redirect()->route('blog-tags.index')->with('toasts', [['type' => 'success', 'message' => 'Tag berhasil dibuat',], ['type' => 'info', 'message' => 'Slug dibuat otomatis']]);
    }

    public function edit(BlogTag $blogTag)
    {
        $title = 'Edit Blog Tag';
        return view('blog_tag.edit', compact('blogTag', 'title'));
    }

    public function update(BlogTagRequest $request, BlogTag $blogTag)
    {
        $blogTag->update($request->validated());

        return redirect()->route('blog-tags.index')->with('toasts', [['type' => 'success', 'message' => 'Tag berhasil diperbarui']]);
    }

    public function destroy(BlogTag $blogTag)
    {
        $blogTag->delete();

        return back()->with('toasts', [['type' => 'success', 'message' => 'Tag berhasil dihapus']]);
    }
}
