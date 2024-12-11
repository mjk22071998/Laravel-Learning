<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/note', [NoteController::class, 'index'])->name('index');
// Route::get('/note/create', [NoteController::class, 'create'])->name('create');
// Route::post('/note', [NoteController::class, 'store'])->name('store');
// Route::get('/note/{id}', [NoteController::class, 'show'])->name('show');
// Route::get('/note/{id}/edit', [NoteController::class, 'edit'])->name('edit');
// Route::put('/note/{id}', [NoteController::class, 'update'])->name('update');
// Route::delete('/note/{id}', [NoteController::class, 'destroy'])->name('destroy');

Route::resource('note', NoteController::class);