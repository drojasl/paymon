<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\Admin\AdminController;
use App\Http\Controllers\Web\Admin\CourseController;
use App\Http\Controllers\Web\Admin\VideoController;
use App\Http\Controllers\Web\UserController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/user', [UserController::class, 'index'])->name('user.index');

Route::prefix('admin')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/courses', [CourseController::class, 'index'])->name('admin.courses.index');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('admin.courses.create');
    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('admin.courses.show');
    Route::post('/courses', [CourseController::class, 'store'])->name('admin.courses.store');

    Route::get('/courses/{course}/videos', [VideoController::class, 'index'])->name('videos.index');
    Route::post('/courses/{course}/videos', [VideoController::class, 'store'])->name('videos.store');
    Route::delete('/courses/videos/{video}', [VideoController::class, 'destroy'])->name('videos.destroy');
});

Route::prefix('user')->group(function() {
    Route::get('/courses', [CourseController::class, 'userIndex'])->name('user.courses.index');
});
