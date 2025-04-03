<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsArticleController;

// ✅ Public Routes (Anyone can access)


Route::get('/articles', [NewsArticleController::class, 'index']);
Route::get('/articles/{id}', [NewsArticleController::class, 'show']);

// ✅ Protected Routes (Require Authentication)
Route::middleware(['auth:sanctum'])->group(function () {
    // Articles (Only authenticated users can create, update, or delete articles)
    Route::post('/articles', [NewsArticleController::class, 'store']);
    Route::put('/articles/{id}', [NewsArticleController::class, 'update']);
    Route::delete('/articles/{id}', [NewsArticleController::class, 'destroy']);

    // Get authenticated user data
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
