<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\OrderController;


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
Route::get('/mail', function () {
   
})->name("mail");

Route::get('/', function () {
    return view('layouts.store.index');
})->name("index");

Route::get('/cart', [CartController::class, 'displayCart'])->name('cart');

Route::prefix('cart')->group(function () {
    Route::post('add', [CartController::class, 'addToCart'])->name('addtocart');
    Route::get('remove', [CartController::class, 'clearCart'])->name('clearcart');
    Route::get('clear/{id}', [CartController::class, 'clearCartElement'])->name('clearcartelement');
    Route::post('update', [CartController::class, 'updateCart'])->name('updatecartelement');
    Route::get('checkout', [CartController::class, 'checkout'])->name('checkout');
});



Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::prefix('/post-categories')->group(function () {
    Route::get('posts/{id}', [PostCategoryController::class, 'categoryPosts'])->name('category.posts');
});
Route::prefix('/shop')->group(function () {
    Route::get('category/{id}', [CategoryController::class, 'categoryProduct'])->name('category.products');
});

Route::get('/blog', [PostController::class, 'index'])->name('blog.index');

Route::resource('post-categories', PostCategoryController::class);
Route::resource('product-categories', CategoryController::class);
Route::resource('post', PostController::class);
Route::resource('comment', CommentController::class);
Route::resource('shop', ProductController::class);
Route::resource('user', UserController::class);
Route::resource('order', OrderController::class);

require __DIR__.'/auth.php';

