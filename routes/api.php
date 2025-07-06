<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\SeoContentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'v1'], function () {
    Route::post('course', [CourseController::class, 'create']);
    Route::post('image', [ImageController::class, 'create']);
    Route::post('seo-content', [SeoContentController::class, 'create']);
});
