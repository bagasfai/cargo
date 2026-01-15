<?php

use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogTagController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home');
});
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
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

require __DIR__ . '/template.php';
