<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\RackController;




Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/users/list', [UserController::class, 'list'])->name('users.list');
    Route::post('/users/status/change/{id}', [UserController::class, 'statusChange'])->name('user.status.change');

    Route::get('/rack/manage', [RackController::class, 'index'])->name('rack.manage');
    Route::post('/rack/list-data', [RackController::class, 'listData'])->name('rack.list.data');
    Route::post('/rack/store', [RackController::class, 'store'])->name('rack.store');
    Route::post('/rack/status/change/{id}', [RackController::class, 'statusChange'])->name('rack.status.change');
    Route::post('/rack/delete/{id}', [RackController::class, 'delete'])->name('rack.delete');
    Route::put('/rack/update/{id}', [RackController::class, 'update'])->name('rack.update');

    Route::get('/genre/manage', [GenreController::class, 'index'])->name('genre.manage');
    Route::post('/genre/list-data', [GenreController::class, 'listData'])->name('genre.list.data');
    Route::post('/genre/store', [GenreController::class, 'store'])->name('genre.store');
    Route::put('/genre/update/{id}', [GenreController::class, 'update'])->name('genre.update');
    Route::post('/genre/delete/{id}', [GenreController::class, 'delete'])->name('genre.delete');
    Route::post('/genre/status/change/{id}', [GenreController::class, 'statusChange'])->name('genre.status.change');

    Route::get('/department/manage', [DepartmentController::class, 'index'])->name('department.manage');
    Route::post('/department/list-data', [DepartmentController::class, 'listData'])->name('department.list.data');
    Route::post('/department/store', [DepartmentController::class, 'store'])->name('department.store');
    Route::put('/department/update/{id}', [DepartmentController::class, 'update'])->name('department.update');
    Route::post('/department/delete/{id}', [DepartmentController::class, 'delete'])->name('department.delete');
    Route::post('/department/status/change/{id}', [DepartmentController::class, 'statusChange'])->name('department.status.change');
});
