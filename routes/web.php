<?php

use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');



Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/forgot-password', [AuthController::class, 'forgot_password'])->name('forgot-password');
Route::get('/register', [AuthController::class, 'register'])->name('register');
