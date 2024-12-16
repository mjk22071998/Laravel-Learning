<?php

use App\Http\Controllers\student\ClassController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\student\StudentController;
use App\Http\Controllers\student\SubjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('class', ClassController::class);
Route::resource('student', StudentController::class);
Route::resource('subject', SubjectController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';