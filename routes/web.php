<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('islogin');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Admin
|
*/

Route::middleware('auth')->group(function () {

    Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('admin/posts/', [PostController::class, "store"])->name('posts.store');
    Route::get('admin/posts/', [PostController::class, "index"])->name('posts.index');
    Route::get('admin/my-posts/', [PostController::class, "myPosts"])->name('posts.my');
    Route::get('admin/posts/create', [PostController::class, "create"])->name('posts.create');
    Route::get('admin/posts/{post}/', [PostController::class, "showForAdmin"])->name('posts.showForAdmin');
    Route::get('admin/posts/{post}/edit', [PostController::class, "edit"])->name('posts.edit')->middleware("can:update,post");
    Route::patch('admin/posts/{post}', [PostController::class, "update"])->name('posts.update')->middleware("can:update,post");
    Route::delete('admin/posts/{post}', [PostController::class, "destroy"])->name('posts.destroy')->middleware("can:delete,post");


    Route::get('admin/update/profile', [AdminController::class, "edit"])->name('admin.profile.edit');
    Route::patch('admin/update/profile', [AdminController::class, "update"])->name('users.profile.update');
});
