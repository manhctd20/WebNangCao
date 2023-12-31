<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\PageController::class, 'home'])->name('home');
Route::get('posts', [App\Http\Controllers\PageController::class, 'posts'])->name('posts');
Route::get('order', [App\Http\Controllers\PageController::class, 'order'])->name('order');
Route::get('change-info/{id}', [App\Http\Controllers\PageController::class, 'change_info'])->name('change-info');
Route::get('posts/{post:slug}', [App\Http\Controllers\PageController::class, 'detailPost'])->name('posts.show');
Route::get('paket-travel', [App\Http\Controllers\PageController::class, 'package'])->name('package');
Route::post('search', [App\Http\Controllers\PageController::class, 'search'])->name('search');
Route::get('userOrder', [App\Http\Controllers\PageController::class, 'userOrder'])->name('userOrder');
Route::get('detail/{travelPackage:slug}', [App\Http\Controllers\PageController::class, 'detail'])->name('detail');
Route::get('contact', [App\Http\Controllers\PageController::class, 'contact'])->name('contact');
Route::post('contact', [App\Http\Controllers\PageController::class, 'getEmail'])->name('contact.email');
Route::post('change-password', [App\Http\Controllers\ChangePasswordController::class, 'changePassword'])->name('change-password');
Route::resource('review', \App\Http\Controllers\Admin\ReviewController::class);
Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => 'isAdmin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
Route::resource('reviews', \App\Http\Controllers\Admin\ReviewController::class);
        Route::resource('cars', \App\Http\Controllers\Admin\CarController::class);
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('travel-packages', \App\Http\Controllers\Admin\TravelPackageController::class);
        Route::resource('travel-packages.galleries', \App\Http\Controllers\Admin\GalleryController::class);
    });
});