<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\PostController;

Route::post('/login', [LoginController::class, 'login']);
Route::get('/all-posts', [PostController::class, 'get']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout']);
    
    // Add protected routes here
});
