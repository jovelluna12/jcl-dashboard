<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::inertia('/', 'Welcome')->name('home');
Route::inertia('/dashboard', 'Dashboard')->middleware(['auth', 'verified'])->name('dashboard');
Route::inertia('/posts', 'Posts')->name('posts');
Route::inertia('/users', 'Users')->name('users');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
