<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\IdeaLikeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::post('ideas/{idea}/comments', [CommentController::class, 'store'])->name('ideas.comments.store')->middleware(['auth']);

Route::delete('ideas/{idea}/comments/{comment}', [CommentController::class, 'destroy'])->name('ideas.comments.delete')->middleware(['auth']);

Route::put('ideas/{idea}/comments/{comment}', [CommentController::class, 'update'])->name('ideas.comments.update')->middleware(['auth']);

Route::get('ideas/{idea}/comments/{comment}/edit', [CommentController::class, 'edit'])->name('ideas.comments.edit')->middleware(['auth']);

Route::resource('ideas', IdeaController::class);

Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');

Route::post('/register', [AuthController::class, 'store'])->middleware('guest');

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');

Route::post('/login', [AuthController::class, 'authenticate'])->middleware('guest');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::resource('users', UserController::class)->only('show','edit','update')->middleware('auth');

Route::resource('users', UserController::class)->only('show');

Route::post('/user/{user}/follow',[FollowerController::class, 'follow'])->middleware('auth')->name('follow');

Route::post('/user/{user}/unfollow',[FollowerController::class, 'unfollow'])->middleware('auth')->name('unfollow');

Route::post('/ideas/{idea}/like',[IdeaLikeController::class, 'like'])->middleware('auth')->name('idea.like');

Route::post('/ideas/{idea}/unlike',[IdeaLikeController::class, 'unlike'])->middleware('auth')->name('idea.unlike');

Route::get('/feed', FeedController::class)->middleware('auth')->name('feed');

Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard')->middleware(['auth', 'can:admin']);

Route::get('/admin/users/{user}/edit', [AdminDashboardController::class, 'edit'])->name('admin.edit-user')->middleware(['auth', 'can:admin']);

Route::get('/admin/users/{user}', [AdminDashboardController::class, 'show'])->name('admin.show-user')->middleware(['auth', 'can:admin']);

Route::put('/admin/users/{user}', [AdminDashboardController::class, 'update'])->name('admin.update-user')->middleware(['auth', 'can:admin']);

Route::delete('/admin/users/{user}', [AdminDashboardController::class, 'destroy'])->name('admin.delete-user')->middleware(['auth', 'can:admin']);


Route::get('/terms', function () {
    return view('terms');
})->name('terms');
//Route::group(['prefix' => 'ideas/', 'as' => 'ideas.'], function () {
    //Route::post('', [IdeaController::class, 'store'])->name('store');

    //Route::get('/{idea}', [IdeaController::class, 'show'])->name('show');

    //Route::get('/{idea}/edit', [IdeaController::class, 'edit'])->name('edit')->middleware('auth');

    //Route::put('/{idea}', [IdeaController::class, 'update'])->name('update')->middleware('auth');

    //Route::delete('/{idea}', [IdeaController::class, 'destroy'])->name('destroy')->middleware('auth');

//});
