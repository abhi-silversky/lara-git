<?php

use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Models\Permission;

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
    return redirect()->route('home');
});
Route::get('public/posts', [HomeController::class, 'index'])->name('home')->middleware('islogin');
Route::get('public/posts/{post}', [PostController::class, 'publicShow'])->name('public.posts.show');


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Admin
|
*/

Route::middleware('auth')->group(function () {
    // user updation form for logged-in user & any user(by admin)
    Route::get('user/{user}/profile', [UserController::class, "edit"])->name('users.edit');
    Route::patch('user/{user}/profile', [UserController::class, "update"])->name('users.update');
});


Route::get('/usr', function () {
    // $user = User::find(2);
    // $user = $user->whereId($user->id)->with('roles')->first();
    // dd($user);
    // $roles = $user->roles->pluck('id')->toArray();
    // dd($roles);

    // ddd($user->load('roles'));
    // Str::contains(Route::currentRouteName(),['admin.users.index','posts.index'
    // ,'posts.my','admin.permissions.index','admin.roles.index','admin.roles.edit'],true)


    $role = Role::find(6);
    $prm = Permission::find(16);
    $slug = "delete-post";



    // $roles = Role::where('id', 6)->whereHas('permissions', function ($q) use ($slug) {
    //     $q->where('slug', $slug);
    // })->exists();
    // $roles = $role->whereHas('permissions', function ($q) use ($slug) {
    //     $q->where('slug', $slug);
    // })->exists();
    // return $roles;

    // $roles = $role->permissions->contains($prm);
    $roles = Role::where('id',6)->whereHas('permissions', function ($q) {
        $q->where('id', 16);
    })->exists();
    ddd($roles);
});
