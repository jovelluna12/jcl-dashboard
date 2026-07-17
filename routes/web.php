<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserManagementController;

Route::inertia('/', 'Welcome')->name('home');
Route::inertia('/dashboard', 'Dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::inertia('/posts', 'Posts')->name('posts');
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts/{id}', [PostController::class, 'show']);
    Route::put('/posts/{id}', [PostController::class, 'update']);
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);
});

Route::middleware('auth', 'role:Administrator')->group(function () {
    Route::get('/users', [UserManagementController::class, 'index']);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
