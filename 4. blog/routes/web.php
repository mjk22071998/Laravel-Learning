<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class, 'getIndex'])->name('home');
Route::get('/about', [PagesController::class, 'getAbout'])->name('about');
Route::get('/contact', [PagesController::class, 'getContact'])->name('contact');

// Modify Post routes to use slugs instead of IDs
Route::resource('post', PostController::class)
    ->parameters(['post' => 'slug']); // This tells Laravel to use 'slug' instead of 'id'