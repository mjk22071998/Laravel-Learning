<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::all();
        return view('subject.index', ['subjects' => $subjects]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
        ]);
        Subject::create($request->all());
        return redirect()->back()->with('message','Subject Created');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $subjectId)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:50',
        ]);

        // Find the subject and update it
        $subject = Subject::findOrFail($subjectId);
        $subject->name = $request->input('name');

        if ($subject->save()) {
            return response()->json(['message' => 'Subject updated successfully.'], 200);
        }

        return response()->json(['message' => 'Failed to update subject.'], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->back()->with('message', 'Subject Deleted');
    }
}