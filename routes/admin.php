<?php

use App\Http\Controllers\Admin\DashboardController;
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
    // Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    // Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    // Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    // Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    // Route::get('/users/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
});
