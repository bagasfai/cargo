<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Blog extends Model
{
    use HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'featured_image',
        'excerpt',
        'content',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'status',
        'published_at',
        'author_id',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Slug
    |--------------------------------------------------------------------------
    */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_category_blog');
    }

    public function tags()
    {
        return $this->belongsToMany(BlogTag::class, 'blog_blog_tag');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes (SEO-friendly)
    |--------------------------------------------------------------------------
    */
    public function scopePublished(Builder $query)
    {
        return $query
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function isPublished(): bool
    {
        return $this->status === 'published'
            && $this->published_at
            && $this->published_at->isPast();
    }

}
