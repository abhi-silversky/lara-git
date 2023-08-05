<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;

Route::get('/', [RoleController::class, 'index'])->name('admin.roles.index');
Route::post('/', [RoleController::class, 'store'])->name('admin.roles.store');
Route::get('/', [RoleController::class, 'index'])->name('admin.roles.index');
