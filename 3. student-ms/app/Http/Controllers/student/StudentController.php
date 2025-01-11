<?php

namespace App\Http\Controllers\student;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\Subject;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return view('student.index', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = ClassModel::all(); // get all classes
        $subjects = Subject::all();
        return view('student.create', ['classes' => $classes, 'subjects' => $subjects]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate the incoming request
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'class_id' => 'required|exists:class_models,id',
        'subjects' => 'required|array',
        'subjects.*' => 'exists:subjects,id',
    ]);

    // Create a new user for the student
    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
    ]);

    // Create a new student linked to the user
    $student = Student::create([
        'user_id' => $user->id,
        'class_id' => $validated['class_id'],
    ]);

    // Sync the subjects to the student
    $student->subjects()->sync($validated['subjects']);

    return redirect()->route('student.index')->with('success', 'Student created successfully.');
}


    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('student.show', ['student' => $student]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('student.edit', ['student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
{
    // Validate the incoming data
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class . ',email,' . $student->user->id],  // Ensuring the email is unique except for the current student's email
    ]);

    // Check if the email has changed
    if ($student->user->email !== $request->email) {
        // If the email is changed, set email_verified_at to null
        $student->user->email_verified_at = null;
        $student->user->save();
    }

    // Update the user's name and email
    $student->user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);


    // Redirect or return a response
    return to_route('student.index')->with('message', 'Student updated successfully');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->user->delete();
        $student->delete();

        return to_route('student.index')->with('message', 'Student deleted');
    }
}