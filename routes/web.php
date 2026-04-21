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
    $sort = request('sort', 'created_at');
    $direction = request('direction', 'desc') === 'asc' ? 'asc' : 'desc';
    $search = trim((string) request('search', ''));

    $sortableFields = ['city.name', 'province.name', 'price_per_kg', 'min_weight', 'estimated_delivery_time', 'created_at'];
    if (! in_array($sort, $sortableFields, true)) {
        $sort = 'created_at';
    }

    $expeditionPricesQuery = \App\Models\ExpeditionPrice::query()
        ->active()
        ->with(['province', 'city'])
        ->when($search !== '', function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('city', fn($city) => $city->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('province', fn($province) => $province->where('name', 'like', "%{$search}%"))
                    ->orWhere('estimated_delivery_time', 'like', "%{$search}%");
            });
        });

    if ($sort === 'city.name') {
        $expeditionPricesQuery
            ->leftJoin('cities', 'expedition_prices.city_id', '=', 'cities.id')
            ->select('expedition_prices.*')
            ->orderBy('cities.name', $direction);
    } elseif ($sort === 'province.name') {
        $expeditionPricesQuery
            ->leftJoin('provinces', 'expedition_prices.province_id', '=', 'provinces.id')
            ->select('expedition_prices.*')
            ->orderBy('provinces.name', $direction);
    } else {
        $expeditionPricesQuery->orderBy($sort, $direction);
    }

    $expeditionPrices = $expeditionPricesQuery
        ->paginate(10)
        ->withQueryString();

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
