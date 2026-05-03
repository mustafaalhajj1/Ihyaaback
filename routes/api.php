<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('books', BookController::class);
});
Route::apiResource('books', BookController::class);
Route::apiResource('authors', AuthorController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('publishers', PublisherController::class);
Route::apiResource('events', EventController::class);
Route::apiResource('users', UserController::class);