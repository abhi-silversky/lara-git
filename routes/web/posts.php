<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


Route::get('my', [PostController::class, "myPosts"])->name('posts.my');
Route::get('/', [PostController::class, "index"])->name('posts.index');

Route::get('create', [PostController::class, "create"])->name('posts.create');
Route::get('{post}', [PostController::class, 'show'])->name('posts.show');

Route::get('{post}/edit', [PostController::class, "edit"])->name('posts.edit')->middleware("can:update,post");
Route::post('/', [PostController::class, "store"])->name('posts.store');

Route::patch('{post}', [PostController::class, "update"])->name('posts.update')->middleware("can:update,post");
Route::delete('{post}', [PostController::class, "destroy"])->name('posts.destroy')->middleware("can:delete,post");
