<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\LoginController as V1LoginController;
use App\Http\Controllers\Api\V1\PostController as V1PostController;

Route::prefix('v1')->group(function () {

    Route::post('/login', [V1LoginController::class, 'login']);
    Route::get('/posts', [V1PostController::class, 'index']);
    Route::get('/post/{id}', [V1PostController::class, 'retrievePost']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [V1LoginController::class, 'logout']);
    });

});
