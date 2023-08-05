<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', [AdminController::class, 'index'])->name('admin.index');


Route::prefix('users')->group(function () {
    Route::get('/', [AdminUserController::class, "index"])->name('admin.users.index');

    Route::get('create', [AdminUserController::class, "create"])->name('admin.users.create');
    Route::post('/', [AdminUserController::class, "store"])->name('admin.users.register');

    Route::get('{user}', [AdminUserController::class, "show"])->name('admin.users.show');
    Route::get('{user}/edit', [AdminUserController::class, "edit"])->name('admin.users.edit');

    Route::delete('{user}', [AdminUserController::class, "destroy"])->name('admin.users.destroy');
    Route::patch('{user}', [AdminUserController::class, "update"])->name('admin.users.update');

    Route::patch('{user}/role/attach', [AdminUserController::class, 'attachRole'])->name('user.role.attach');
    Route::patch('{user}/role/detach', [AdminUserController::class, 'detachRole'])->name('user.role.detach');
});
