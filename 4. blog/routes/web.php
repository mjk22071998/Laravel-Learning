<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class, 'getIndex'])->name('home');
Route::get('/about', [PagesController::class, 'getAbout'])->name('about');
Route::get('/contact', [PagesController::class, 'getContact'])->name('contact');
Route::resource('post', PostController::class);