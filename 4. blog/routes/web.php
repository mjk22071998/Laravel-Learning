<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\blogController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;

Route::get('/', [PagesController::class, 'getIndex'])->name('home');
Route::get('/about', [PagesController::class, 'getAbout'])->name('about');
Route::get('/contact', [PagesController::class, 'getContact'])->name('contact');

// public routes
Route::get('/blog/{slug}', [BlogController::class, 'getSingle'])->name('blog.single');
Route::get('/blog', [BlogController::class, 'getIndex'])->name('blog.index');

// Adding comment route
Route::post('/{postId}/comment', [BlogController::class, 'postComment'])->name('comment.store');
Route::delete('/comment/{commentId}', [BlogController::class, 'deleteComment'])->name('comment.delete');

// Grouping routes that use the guest middleware
Route::middleware(['guest'])->group(function () {
    // AuthenticationController handles login, registration, and password reset
    Route::get('/login', [AuthenticationController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthenticationController::class, 'login']);

    Route::get('/register', [AuthenticationController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthenticationController::class, 'register']);
    
    Route::get('/forgot-password', [AuthenticationController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [AuthenticationController::class, 'sendResetLinkEmail'])->name('password.email');
    
    Route::get('/reset-password/{token}', [AuthenticationController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [AuthenticationController::class, 'resetPassword'])->name('password.update');
});

// Logout route (not under guest middleware, as it's for authenticated users)
Route::middleware(['auth'])->group(function () {
    // Logout route
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');

    // Post crud routes
    Route::resource('/post', PostController::class);

    // Category Routes
    Route::resource('/category', CategoryController::class)->only(['index', 'store', 'update', 'destroy']);
    
    // Tag Routes
    Route::resource('/tag', TagController::class)->only(['index', 'store', 'update', 'destroy']);

});