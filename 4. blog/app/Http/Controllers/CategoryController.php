<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use \Exception;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
        ]);

        try {
            Category::create($request->all());
            return back()->with('success', 'Category created successfully');
        } catch (Exception $e) {
            return back()->with('error', 'Error occurred while creating category');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $category->name = $request->input('name');

        if ($category->save()) {
            return response()->json(['success' => 'Category updated successfully']);
        }

        return response()->json(['error' => 'Failed to update category'], 400);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $categoryId)
    {
        try {
            // Find the category by ID or fail if not found
            $category = Category::findOrFail($categoryId);

            // Delete the category
            $category->delete();

            // Redirect to the categories list with success message
            return back()->with('success' , 'Category deleted successfully');
        } catch (Exception $e) {
            // Returning the actual exception message
            return back()->with('error' , 'Failed to delete category');
        }
    }
}