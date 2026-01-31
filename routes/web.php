<?php

use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogTagController;
use App\Http\Controllers\CityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VillageController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    $blogs = \App\Models\Blog::latest()->take(5)->paginate(10);
    return view('home', compact('blogs'));
});
Route::get('/admin', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    } else {
        return redirect('/login');
    }
});

Route::resource('users', UserController::class);
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('blogs', BlogController::class);
    Route::resource('blog-categories', BlogCategoryController::class);
    Route::resource('blog-tags', BlogTagController::class);
    Route::resource('provinces', ProvinceController::class);
    Route::resource('cities', CityController::class);
    Route::resource('districts', DistrictController::class);
    Route::resource('villages', VillageController::class);
});

Route::middleware(['auth'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

require __DIR__ . '/template.php';
