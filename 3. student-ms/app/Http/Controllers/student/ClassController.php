<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = ClassModel::all();
        return view('class.index', ['classes' => $classes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
        ]);
        ClassModel::create($request->all());
        return redirect()->back()->with('message','Subject Created');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $classModelid)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:50',
        ]);

        // Find the subject and update it
        $classModel = ClassModel::findOrFail($classModelid);
        $classModel->name = $request->input('name');

        if ($classModel->save()) {
            return response()->json(['message' => 'Class updated successfully.'], 200);
        }

        return response()->json(['message' => 'Failed to update class.'], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassModel $classModel)
    {
        $classModel->delete();
        return redirect()->back()->with('message', 'Class Deleted');
    }
}