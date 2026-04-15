<?php

use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogTagController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ExpeditionPriceController;
use App\Http\Controllers\PublicBlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VillageController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    $featuredPosts = \App\Models\Blog::active()->featured()->latest('published_at')->with('media')->take(4)->get();
    $expeditionPrices = \App\Models\ExpeditionPrice::active()
        ->with(['province', 'city'])
        ->latest()
        ->paginate(10);
    return view('home', compact('featuredPosts', 'expeditionPrices'));
});

/*
|--------------------------------------------------------------------------
| Public Blog Routes
|--------------------------------------------------------------------------
*/
Route::get('/blog/{blog}', [PublicBlogController::class, 'show'])->name('blog.show');
Route::get('/admin', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    } else {
        return redirect('/login');
    }
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('blog-categories', BlogCategoryController::class);
    Route::resource('blog-tags', BlogTagController::class);
    Route::resource('provinces', ProvinceController::class);
    Route::resource('cities', CityController::class);
    Route::resource('districts', DistrictController::class);
    Route::resource('villages', VillageController::class);
    Route::resource('expedition-prices', ExpeditionPriceController::class);
});

Route::middleware(['auth'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Location API endpoints (for cascading dropdowns)
|--------------------------------------------------------------------------
*/
Route::prefix('api')->group(function () {
    Route::get('provinces/{province}/cities', function (\App\Models\Province $province) {
        return $province->cities()->orderBy('name')->get(['id', 'name']);
    });
    Route::get('cities/{city}/districts', function (\App\Models\City $city) {
        return $city->districts()->orderBy('name')->get(['id', 'name']);
    });
    Route::get('districts/{district}/villages', function (\App\Models\District $district) {
        return $district->villages()->orderBy('name')->get(['id', 'name']);
    });
});

require __DIR__ . '/template.php';
