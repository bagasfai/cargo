<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\BlogTag;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BlogService
{
    /**
     * Create a new blog post with categories, tags, and featured image.
     *
     * @param  array<string, mixed>  $data
     * @param  int                    $authorId
     * @param  UploadedFile|null      $featuredImage
     * @return Blog
     */
    public function store(array $data, int $authorId, ?UploadedFile $featuredImage = null): Blog
    {
        return DB::transaction(function () use ($data, $authorId, $featuredImage): Blog {
            $categories = $data['categories'] ?? [];
            $tags       = $data['tags'] ?? [];
            unset($data['categories'], $data['tags'], $data['featured_image']);

            $data['author_id'] = $authorId;
            $this->applySeoFallbacks($data);
            $this->applyPublishedAt($data);

            $blog = Blog::create($data);

            $this->attachFeaturedImage($blog, $featuredImage);
            $this->syncCategories($blog, $categories);
            $this->syncTags($blog, $tags);

            return $blog;
        });
    }

    /**
     * Update an existing blog post with categories, tags, and featured image.
     *
     * @param  Blog                   $blog
     * @param  array<string, mixed>   $data
     * @param  UploadedFile|null       $featuredImage
     * @return Blog
     */
    public function update(Blog $blog, array $data, ?UploadedFile $featuredImage = null): Blog
    {
        return DB::transaction(function () use ($blog, $data, $featuredImage): Blog {
            $categories = $data['categories'] ?? [];
            $tags       = $data['tags'] ?? [];
            unset($data['categories'], $data['tags'], $data['featured_image']);

            // Don't change slug on published posts
            if ($blog->status === 'published') {
                unset($data['slug']);
            }

            $this->applySeoFallbacks($data);
            $this->applyPublishedAt($data, $blog);

            $blog->update($data);

            $this->attachFeaturedImage($blog, $featuredImage);
            $this->syncCategories($blog, $categories);
            $this->syncTags($blog, $tags, detachWhenEmpty: true);

            return $blog;
        });
    }

    /**
     * Attach a featured image via Spatie Media Library.
     * The 'featured_images' collection is configured as singleFile(),
     * so adding a new one automatically replaces the old one.
     *
     * @param  Blog               $blog
     * @param  UploadedFile|null   $file
     */
    private function attachFeaturedImage(Blog $blog, ?UploadedFile $file): void
    {
        if (! $file) {
            return;
        }

        $blog->addMedia($file)
            ->toMediaCollection('featured_images');
    }

    /**
     * Apply SEO field fallbacks when values are not explicitly provided.
     *
     * @param  array<string, mixed>  $data
     */
    private function applySeoFallbacks(array &$data): void
    {
        $data['seo_title']       ??= $data['title'] ?? null;
        $data['seo_description'] ??= $data['excerpt'] ?? null;
    }

    /**
     * Auto-populate published_at when status is 'published' and the field is empty.
     *
     * @param  array<string, mixed>  $data
     * @param  Blog|null              $blog  Existing blog (on update) to check current value.
     */
    private function applyPublishedAt(array &$data, ?Blog $blog = null): void
    {
        if (($data['status'] ?? null) !== 'published') {
            return;
        }

        $alreadySet = ! empty($data['published_at'])
            || ($blog && $blog->published_at);

        if (! $alreadySet) {
            $data['published_at'] = now();
        }
    }

    /**
     * Sync blog categories.
     *
     * @param  Blog          $blog
     * @param  array<int>    $categoryIds
     */
    private function syncCategories(Blog $blog, array $categoryIds): void
    {
        if (empty($categoryIds)) {
            return;
        }

        $blog->categories()->sync($categoryIds);
    }

    /**
     * Resolve tag names (or IDs) to BlogTag models and sync them.
     *
     * @param  Blog                $blog
     * @param  array<mixed>|string $tags
     * @param  bool                $detachWhenEmpty
     */
    private function syncTags(Blog $blog, array|string $tags, bool $detachWhenEmpty = false): void
    {
        $resolved = $this->resolveTags($tags);

        if ($resolved->isNotEmpty()) {
            $blog->tags()->sync($resolved->pluck('id'));
            return;
        }

        if ($detachWhenEmpty) {
            $blog->tags()->sync([]);
        }
    }

    /**
     * Normalize tag input (string or array) into a collection of BlogTag models.
     *
     * @param  array<mixed>|string $tags
     * @return Collection<int, BlogTag>
     */
    private function resolveTags(array|string $tags): Collection
    {
        if (is_string($tags)) {
            $tags = explode(',', $tags);
        }

        return collect($tags)
            ->map(fn(string $tag): string => trim($tag))
            ->filter()
            ->unique()
            ->map(fn(string $tag): BlogTag => BlogTag::firstOrCreate(['name' => $tag]));
    }
}
