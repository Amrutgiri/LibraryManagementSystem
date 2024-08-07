<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;




Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/users/list', [UserController::class, 'list'])->name('users.list');
    Route::post('/users/status/change/{id}', [UserController::class, 'statusChange'])->name('user.status.change');
    // Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    // Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    // Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    // Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    // Route::get('/users/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
});
