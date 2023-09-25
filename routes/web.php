<?php

use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminPhotoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class,'index'])->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard.index');
    Route::resource('users',AdminUserController::class);
    Route::resource('posts',AdminPostController::class);
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('photos',AdminPhotoController::class);
});


