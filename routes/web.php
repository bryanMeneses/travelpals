<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LandingPageController;

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

Auth::routes();

Route::get('/', [LandingPageController::class, 'index'])->name('landingpage');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::get('/profile/{user:username}', [ProfileController::class, 'show'])->name('profile.show');
Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::resource('posts', PostController::class)->only([
  'index',
  'store',
  'destroy'
]);

// Post Likes
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes');
Route::delete('/posts/{post}/dislikes', [LikeController::class, 'destroy'])->name('posts.dislikes');

// Post Comments
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('posts.comments');
Route::delete('/posts/{comment}/comments', [CommentController::class, 'destroy'])->name('posts.comments');