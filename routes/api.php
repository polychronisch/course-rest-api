<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CourseController;

Route::prefix('courses')->group(function () {
    Route::get('/', [CourseController::class, 'index']);
    Route::get('{course}', [CourseController::class, 'show']);
    Route::post('/', [CourseController::class, 'store']);
    Route::put('{course}', [CourseController::class, 'update']);
    Route::patch('{course}', [CourseController::class, 'update']);
    Route::delete('{course}', [CourseController::class, 'destroy']);    
});

