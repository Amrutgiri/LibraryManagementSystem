<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\RackController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\PrintController;
use App\Http\Controllers\Admin\BarcodeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;




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

    Route::get('/language/manage', [LanguageController::class, 'index'])->name('language.manage');
    Route::post('/language/list-data', [LanguageController::class, 'listData'])->name('language.list.data');
    Route::post('/language/store', [LanguageController::class, 'store'])->name('language.store');
    Route::put('/language/update/{id}', [LanguageController::class, 'update'])->name('language.update');
    Route::post('/language/delete/{id}', [LanguageController::class, 'delete'])->name('language.delete');
    Route::post('/language/status/change/{id}', [LanguageController::class, 'statusChange'])->name('language.status.change');

    Route::get('/book/manage', [BookController::class, 'index'])->name('book.manage');
    Route::post('/book/list-data', [BookController::class, 'listData'])->name('book.list.data');
    Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
    Route::post('/book/store', [BookController::class, 'store'])->name('book.store');
    Route::get('/book/edit/{id}', [BookController::class, 'edit'])->name('book.edit');
    Route::post('/book/update/{id}', [BookController::class, 'update'])->name('book.update');
    Route::post('/book/delete/{id}', [BookController::class, 'delete'])->name('book.delete');
    Route::post('/book/delete-image/{bookId}', [BookController::class, 'deleteImage'])->name('book.delete.image');
    Route::post('/book/status/change/{id}', [BookController::class, 'statusChange'])->name('book.status.change');

    Route::post('/barcode/generate', [BarcodeController::class, 'generateBarcode'])->name('book.barcode.generate');
    Route::get('/barcode/manage/{bookId}', [BarcodeController::class, 'getBarcode'])->name('book.barcode.manage');
    Route::post('/barcode/list-data/{bookId}', [BarcodeController::class, 'listData'])->name('barcode.list.data');
    Route::get('/barcode/download/{bookId}', [BarcodeController::class, 'downloadBarcode'])->name('book.barcode.download');
    Route::post('/barcode/delete/{id}', [BarcodeController::class, 'delete'])->name('barcode.delete');
    Route::get('/barcode/delete/all/{bookId}', [BarcodeController::class, 'deleteAllBarcode'])->name('barcode.delete.all');

    // All Print Routes
    Route::get('/print/book/barcode/{bookId}', [PrintController::class, 'oneBookBarcodePrint'])->name('book.barcode.print.all');
    // Route::get('/print/book/barcode/{bookId}', [PrintController::class, 'printBookBarcode'])->name('print.book.barcode');

    // All Settings Routes
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::post('/settings/update/{id}', [SettingController::class, 'update'])->name('settings.update');
});
