<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::query()
            ->where('user_id', request()->user()->id)
            ->orderBy("created_at", "desc")->paginate(15);
        return view('note.index', ['notes' => $notes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('note.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'note' => ['required', 'string'],
        ]);

        $note = Note::create([
            'user_id' => $request->user()->id,
            'name' => $request->name,
            'note' => $request->note
        ]);
        return to_route('note.show', $note);
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        if ($note->user_id !== request()->user()->id) {
            abort(403);
        } else {
            return view('note.show', ['note' => $note]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        if ($note->user_id !== request()->user()->id) {
            abort(403);
        } else {
            return view('note.edit', ['note' => $note]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        if ($note->user_id !== request()->user()->id) {
            abort(403);

        } else {

            $data = $request->validate([
                'name' => ['required', 'string'],
                'note' => ['required', 'string'],
            ]);

            $note->update($data);
            
            return to_route('note.show', $note);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        if ($note->user_id !== request()->user()->id) {
            abort(403);
        } else {
            $note->delete();
        }
    }
}