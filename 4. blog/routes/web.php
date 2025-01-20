<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\blogController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class, 'getIndex'])->name('home');
Route::get('/about', [PagesController::class, 'getAbout'])->name('about');
Route::get('/contact', [PagesController::class, 'getContact'])->name('contact');
Route::resource('post', PostController::class);

// public routes
Route::get('/blog/{slug}', [BlogController::class, 'getSingle'])->name('blog.single');
Route::get('/blog', [BlogController::class, 'getIndex'])->name('blog.index');