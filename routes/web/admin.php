<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController as AdminUserController;

Route::get('/', [AdminController::class, 'index'])->name('admin.index');

Route::get('users', [AdminUserController::class, "index"])->name('admin.users.index');

Route::get('users/create', [AdminUserController::class, "create"])->name('admin.users.create');
Route::post('users/', [AdminUserController::class, "store"])->name('admin.users.register');

Route::get('users/{user}', [AdminUserController::class, "show"])->name('admin.users.show');
Route::get('users/{user}/edit', [AdminUserController::class, "edit"])->name('admin.users.edit');

Route::delete('users/{user}', [AdminUserController::class, "destroy"])->name('admin.users.destroy');
Route::patch('users/{user}', [AdminUserController::class, "update"])->name('admin.users.update');
