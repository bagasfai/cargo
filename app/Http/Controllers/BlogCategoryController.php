<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogCategoryRequest;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Blog Categories';
        $categories = BlogCategory::query()
            ->when($request->name, fn($q) => $q->where('name', 'like', "%{$request->name}%"))
            ->when($request->description, fn($q) => $q->where('description', 'like', "%{$request->description}%"))
            ->when($request->created_at, fn($q) => $q->whereDate('created_at', $request->created_at))
            ->when($request->sort, function ($q) use ($request) {
                $q->orderBy($request->sort, $request->direction);
            })
            ->paginate(10)
            ->withQueryString();

        return view('blog_category.index', compact('categories', 'title'));
    }

    public function create()
    {
        $title = 'Create Blog Category';
        $categories = BlogCategory::select('id', 'name')->get();
        return view('blog_category.create', compact('title', 'categories'));
    }

    public function store(BlogCategoryRequest $request)
    {
        BlogCategory::create($request->validated());

        return redirect()->route('blog-categories.index')->with('success', 'Blog Category berhasil dibuat');
    }

    public function edit(BlogCategory $blogCategory)
    {
        $title = 'Edit Blog Category';
        return view('blog_category.edit', compact('blogCategory', 'title'));
    }

    public function update(BlogCategoryRequest $request, BlogCategory $blogCategory)
    {
        $blogCategory->update($request->validated());

        return redirect()->route('blog-categories.index')->with('success', 'Blog Category berhasil diperbarui');
    }

    public function destroy(BlogCategory $blogCategory)
    {
        $blogCategory->delete();

        return back()->with('success', 'Blog Category berhasil dihapus');
    }
}
