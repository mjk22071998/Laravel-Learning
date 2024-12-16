# Laravel Basics

## Creating Models along with migrations

`php artisan make:model Note -m`

## Creating Controller

`php artisan make:controller NoteController --resource --model=Note`

## Creating View

`php artisan make:view note.index`

## Creating Factory

`php artisan make:factory NoteFactory --model=Note`

## Migrating and seeding default data

`artisan migrate:fresh --seed`

## Making routes via resources

`Route::resource('notes', NoteController::class);`

This will generate all following

```php
    Route::get('/notes', [NoteController::class, 'index'])->name('notes.index'); // List all notes
    Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create'); // Show form to create a new note
    Route::post('/notes', [NoteController::class, 'store'])->name('notes.store'); // Store a new note
    Route::get('/notes/{note}', [NoteController::class, 'show'])->name('notes.show'); // Show a specific note
    Route::get('/notes/{note}/edit', [NoteController::class, 'edit'])->name('notes.edit'); // Show form to edit a specific note
    Route::put('/notes/{note}', [NoteController::class, 'update'])->name('notes.update'); // Update a specific note
    Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy'); // Delete a specific note
```
