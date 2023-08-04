<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

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

Route::get('/', function () {
    return redirect('/posts');
});
Route::get('/posts', [HomeController::class, 'index'])->name('home')->middleware('islogin');
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

    Route::prefix('users')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('user.index');
        Route::get('my-posts', [PostController::class, "myPosts"])->name('posts.my');
        Route::get('posts', [PostController::class, "index"])->name('posts.index');

        Route::get('posts/create', [PostController::class, "create"])->name('posts.create');
        Route::get('posts/{post}', [AdminPostController::class, "show"])->name('posts.showForAdmin');

        Route::get('posts/{post}/edit', [PostController::class, "edit"])->name('posts.edit')->middleware("can:update,post");
        Route::post('posts/', [PostController::class, "store"])->name('posts.store');

        Route::patch('posts/{post}', [PostController::class, "update"])->name('posts.update')->middleware("can:update,post");
        Route::delete('posts/{post}', [PostController::class, "destroy"])->name('posts.destroy')->middleware("can:delete,post");
    });


    // user updation form for logged-in user & any user(by admin)
    Route::middleware('can:view,user')->group(function () {
        Route::get('user/{user}/profile', [UserController::class, "edit"])->name('users.edit');
        Route::patch('user/{user}/profile', [UserController::class, "update"])->name('users.update');
    });



    /*
     *  only admin operation
    */
    Route::prefix("admin")->middleware(['role:admin'])->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('users', [AdminUserController::class, "index"])->name('admin.users.index');
        Route::get('users/{user}', [AdminUserController::class, "show"])->name('admin.users.show');
        Route::get('users/create', [AdminUserController::class, "create"])->name('admin.users.create');
        Route::delete('users/{user}', [AdminUserController::class, "destroy"])->name('admin.users.destroy');
        Route::get('users/{user}/edit', [AdminUserController::class, "edit"])->name('admin.users.edit');
        Route::patch('users/{user}', [AdminUserController::class, "update"])->name('admin.users.update');
    });
});
