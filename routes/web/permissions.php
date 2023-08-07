<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PermissionController;

Route::get('/', [PermissionController::class, 'index'])->name('admin.permissions.index');



// Route::get('/', [PermissionController::class, 'index'])->name('permission.index');
Route::get('/{permission}', [PermissionController::class, 'edit'])->name('permissions.edit');
Route::post('/', [PermissionController::class, 'store'])->name('permissions.store');
Route::patch('/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
Route::delete('/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

// Route::patch('{role}/permission/attach', [RoleController::class, 'attachPermission'])->name('roles.attach.permission');
// Route::patch('{role}/permission/detach', [RoleController::class, 'detachPermission'])->name('roles.detach.permission');
