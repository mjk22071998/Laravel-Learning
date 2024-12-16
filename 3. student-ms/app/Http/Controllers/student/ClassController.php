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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('note.show');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassModel $classModel)
    {
        return view('class.show', ['classModel' => $classModel]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassModel $classModel)
    {
        return view('class.edit', ['classModel' => $classModel]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassModel $classModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassModel $classModel)
    {
        //
    }
}