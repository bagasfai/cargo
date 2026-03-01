# Copilot Instructions for Cargo

## Project Overview
Laravel 12 admin panel application for a cargo/expedition service with blog CMS, location management (provinces/cities/districts/villages), and user role-based access control.

## Tech Stack
- **Backend**: PHP 8.3+, Laravel 12
- **Frontend**: Vite 7, Tailwind CSS 4, Alpine.js 3
- **Auth**: Laravel Fortify (no Jetstream/Breeze)
- **Testing**: Pest (not PHPUnit directly)
- **Key packages**: Spatie Permission, Spatie Media Library, Spatie Sluggable, Artesaos SEOTools

## Development Commands
```bash
# Start all dev services (server, queue, logs, vite) concurrently
composer dev

# Run tests
composer test

# Code formatting
./vendor/bin/pint

# Deployment (manual)
git pull origin main && php artisan migrate --force
```

## Architecture Patterns

### Code Organization
- Follow Laravel conventions strictly
- **Service classes** for business logic (keep controllers thin)
- Use repository pattern only when query complexity justifies it
- Controllers: validate → delegate to service → return response

### Controllers & Form Requests
- Controllers use resource routing (`Route::resource()`) under `/admin` prefix
- Validation logic lives in dedicated FormRequest classes in `app/Http/Requests/`
- Example: `BlogRequest` handles all Blog validation rules

### Models
- Use Spatie's `HasSlug` trait for auto-slug generation (see `Blog.php`)
- Define `$fillable`, `$casts`, relationships, and scopes in dedicated sections
- Location models (`Province`, `City`, `District`, `Village`) form a hierarchical relationship chain

### SEO Handling
- Use `App\Helpers\SeoManager` for SEO meta tag configuration
- Blog models have `seo_title`, `seo_description`, `seo_keywords` fields
- SEOTools facade from Artesaos for meta tag rendering

### Frontend Structure
- Blade layouts in `resources/views/layouts/app.blade.php`
- Alpine.js stores for theme (`$store.theme`) and sidebar state (`$store.sidebar`)
- Components lazy-loaded in `app.js` based on DOM element presence
- Dark mode support via `.dark` class on `<html>`

### Admin Routes
All admin routes require `auth` middleware and use `/admin` prefix:
```php
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('blogs', BlogController::class);
    // ...
});
```

## Key Directories
- `app/Helpers/` - Static helper classes (`SeoManager`, `MenuHelper`)
- `app/Actions/Fortify/` - Fortify action classes for auth workflows
- `resources/views/components/` - Reusable Blade components organized by type
- `config/` - Package configs (seotools, permission, media-library, etc.)

## Database Conventions
- Pivot tables follow pattern: `{model1}_{model2}` (e.g., `blog_category_blog`)
- Timestamps disabled on reference data models (e.g., `Province`)
- Use DB transactions for multi-model operations (see `BlogController::store`)

## ExpeditionPrice (Shipping Cost)
Core pricing model for cargo cost calculation:
- Determines shipping cost by **expedition**, **route** (origin/destination), and **weight range**
- Used during order creation to calculate total shipping cost
- Pricing varies by: destination city/district, service type, weight tier

## Environment Configuration
| Setting | Local/Staging | Production |
|---------|---------------|------------|
| Expedition APIs | Sandbox | Live credentials |
| Queue driver | sync/database | redis |
| Cache driver | file/array | redis |
| Debug mode | enabled | disabled |

Update `.env` accordingly; never commit credentials.

## Testing
- Pest configuration in `tests/Pest.php`
- Feature tests extend `Tests\TestCase`
- RefreshDatabase trait available but commented out by default

## Menu System
Navigation defined in `App\Helpers\MenuHelper::getMainNavItems()` - update this when adding new admin sections.
