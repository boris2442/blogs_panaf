<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\Frontend\PostFrontendController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Posts CRUD
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/posts', [PostController::class, 'index'])->name('admin.posts.index');

    Route::get('/admin/posts/create', [PostController::class, 'create'])->name('admin.posts.create');

    Route::post('/admin/posts', [PostController::class, 'store'])->name('admin.posts.store');

    Route::get('/admin/posts/{post:slug}', [PostController::class, 'show'])->name('admin.posts.show');

    Route::get('/admin/posts/{post:slug}/edit', [PostController::class, 'edit'])->name('admin.posts.edit');

    Route::put('/admin/posts/{post:slug}', [PostController::class, 'update'])->name('admin.posts.update');

    Route::delete('/admin/posts/{post:slug}', [PostController::class, 'destroy'])->name('admin.posts.destroy');

});

Route::get('/blogs', [PostFrontendController::class, 'index'])->name('posts.index');
Route::get('/blogs/{post:slug}', [PostFrontendController::class, 'show'])->name('posts.show');

// Ajouter un commentaire à un post
Route::post('/blogs/{post:slug}/comment', [CommentController::class, 'store'])
    ->middleware('auth')
    ->name('comments.store');





require __DIR__ . '/auth.php';
