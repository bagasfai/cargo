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
        $search = $request->get('search');

        $tags = BlogTag::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
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

    public function store(Request $request)
    {
        foreach ($request->input('tags', []) as $tagName) {
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
