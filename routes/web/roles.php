<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;

Route::get('/', [RoleController::class, 'index'])->name('admin.roles.index');
Route::get('/{role}', [RoleController::class, 'edit'])->name('admin.roles.edit');
Route::post('/', [RoleController::class, 'store'])->name('admin.roles.store');
Route::patch('/{role}', [RoleController::class, 'update'])->name('admin.roles.update');
Route::delete('/{role}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');
