# Laravel Basics

## Creating Models along with migrations

```bash
php artisan make:model Note -m
```

## Creating Controller

```bash
php artisan make:controller NoteController --resource --model=Note
```

## Creating View

```bash
php artisan make:view note.index
```

## Creating Factory

```bash
php artisan make:factory NoteFactory --model=Note
```

## Migrating and seeding default data

```bash
php artisan migrate:fresh --seed
```

## Making routes via resources

```php
Route::resource('notes', NoteController::class);
```

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

## Passing multiple variables to a page

```php
    return view('dashboard', [
        'studentCount' => $studentCount,
        'classCount' => $classCount,
        'subjectCount' => $subjectCount,
    ]);
```

## Grouping routes

```php
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::resource('class', ClassController::class);
        Route::resource('student', StudentController::class);
        Route::resource('subject', SubjectController::class);
    });
```
