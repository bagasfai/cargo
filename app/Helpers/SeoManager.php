<?php

namespace App\Helpers;

use App\Models\Blog;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;

class SeoManager
{
    public static function forBlog(Blog $blog): void
    {
        SEOTools::setTitle(
            $blog->seo_title ?: $blog->title
        );

        SEOTools::setDescription(
            $blog->seo_description ?: $blog->excerpt
        );

        SEOTools::setCanonical(
            url()->current()
        );

        SEOMeta::addKeyword(
            explode(',', $blog->tags->pluck('name')->implode(','))
        );

        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'article');

        if ($blog->seo_keywords) {
            SEOTools::metatags()->addKeyword(
                explode(',', $blog->seo_keywords)
            );
        }

        if ($blog->featured_image_url) {
            SEOTools::opengraph()->addImage($blog->featured_image_url);
        }

        if ($blog->published_at) {
            SEOTools::opengraph()->addProperty(
                'article:published_time',
                $blog->published_at->toIso8601String()
            );
        }
    }
}
