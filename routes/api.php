<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\VideoController;
use App\Http\Controllers\API\ProgressController;


Route::get('courses', [CourseController::class, 'index']);
Route::get('courses/search', [CourseController::class, 'search']);
Route::post('courses/{course}/register', [CourseController::class, 'register']);
Route::get('courses/{course}/videos', [CourseController::class, 'videos']);
Route::get('courses/{course}/progress', [ProgressController::class, 'getCourseProgress']);

Route::post('videos/{video}/comment', [VideoController::class, 'storeComment']);
Route::post('videos/{video}/like', [VideoController::class, 'like']);
Route::post('videos/{video}/update-progress', [ProgressController::class, 'updateProgress']);
