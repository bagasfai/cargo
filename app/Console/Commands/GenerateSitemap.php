<?php

namespace App\Console\Commands;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sitemap.xml for the website';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('Starting sitemap generation...');

        $sitemap = Sitemap::create();

        // === Static pages ===
        $sitemap->add(
            Url::create('/')
                ->setPriority(1.0)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
        );

        $sitemap->add(
            Url::create('/blog')
                ->setPriority(0.9)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
        );

        // === Blogs ===
        Blog::published()->each(function ($blog) use ($sitemap) {
            $sitemap->add(
                Url::create("/blog/{$blog->slug}")
                    ->setLastModificationDate($blog->updated_at)
                    ->setPriority(0.8)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        });

        // === Blog categories ===
        BlogCategory::all()->each(function ($category) use ($sitemap) {
            $sitemap->add(
                Url::create("/blog/kategori/{$category->slug}")
                    ->setPriority(0.6)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));

        Log::info('Sitemap generated successfully.');

        return self::SUCCESS;
    }
}
