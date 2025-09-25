<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostController;

Route::inertia('/', 'Welcome')->name('home');
Route::inertia('/dashboard', 'Dashboard')->middleware(['auth', 'verified'])->name('dashboard');
Route::inertia('/posts', 'Posts')->name('posts');
Route::inertia('/users', 'Users')->name('users');

Route::middleware(['auth', 'auth:sanctum'])->group(function () {
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/all-posts', [PostController::class, 'get']);
    Route::delete('/post/{id}', [PostController::class, 'delete']);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
