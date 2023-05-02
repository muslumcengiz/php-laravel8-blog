<?php

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('blog')->middleware('auth')->group(function(){
    Route::get('/posts', [\App\Http\Controllers\Posts::class, 'index'])->name('posts');
    Route::get('/posts/create', [\App\Http\Controllers\Posts::class, 'create'])->name('posts.create');
    Route::post('/posts', [\App\Http\Controllers\Posts::class, 'store'])->name('posts.store');

    Route::get('/posts/{id}', [\App\Http\Controllers\Posts::class, 'show'])->name('posts.show');
    Route::post('/posts/comment', [\App\Http\Controllers\Comments::class, 'store'])->name('posts.comments.store');
    Route::get('/posts/like/{id}', [\App\Http\Controllers\Likes::class, 'store'])->name('posts.likes.store');
    Route::get('/posts/unlike/{id}', [\App\Http\Controllers\Likes::class, 'delete'])->name('posts.likes.delete');
});

Route::prefix('admin')->middleware(['auth', 'role:Admin'])->group(function (){
    Route::get('/', [\App\Http\Controllers\Admin\Home::class, 'index'])->name('admin');
    Route::get('/posts', [\App\Http\Controllers\Admin\Posts::class, 'index'])->name('admin.posts');
    Route::get('/posts/delete/{id}', [\App\Http\Controllers\Admin\Posts::class, 'delete'])->name('admin.posts.delete');
    Route::get('/posts/edit/{id}', [\App\Http\Controllers\Admin\Posts::class, 'edit'])->name('admin.posts.edit');
    Route::put('/posts/edit/{id}', [\App\Http\Controllers\Admin\Posts::class, 'update'])->name('admin.posts.update');

    Route::get('/posts/comments', [\App\Http\Controllers\Admin\Comments::class, 'index'])->name('admin.posts.comments');
    Route::get('/posts/comments/delete/{id}', [\App\Http\Controllers\Admin\Comments::class, 'delete'])->name('admin.posts.comments.delete');

    Route::get('/users', [\App\Http\Controllers\Admin\Users::class, 'index'])->name('admin.users');
    Route::get('/users/delete/{id}', [\App\Http\Controllers\Admin\Users::class, 'delete'])->name('admin.users.delete');
    Route::get('/users/edit/{id}', [\App\Http\Controllers\Admin\Users::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/edit/{id}', [\App\Http\Controllers\Admin\Users::class, 'update'])->name('admin.users.update');
    Route::get('/users/ban/{id}', [\App\Http\Controllers\Admin\Users::class, 'ban'])->name('admin.users.ban');
    Route::get('/users/unban/{id}', [\App\Http\Controllers\Admin\Users::class, 'unBan'])->name('admin.users.unban');
});
