<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use \Exception;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
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
            Tag::create($request->all());
            return back()->with('success', 'Tag created successfully');
        } catch (Exception $e) {
            return back()->with('error', 'Error occurred while creating Tag');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $tagId)
    {
        $tag = Tag::findOrFail($tagId);
        $tag->name = $request->input('name');

        if ($tag->save()) {
            return response()->json(['success' => 'Tag updated successfully']);
        }

        return response()->json(['error' => 'Failed to update Tag'], 400);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $tagId)
    {
        try {
            // Find the Tag by ID or fail if not found
            $tag = Tag::findOrFail($tagId);

            // Delete the Tag
            $tag->delete();

            // Redirect to the tags list with success message
            return back()->with('success' , 'Tag deleted successfully');
        } catch (Exception $e) {
            // Returning the actual exception message
            return back()->with('error' , 'Failed to delete Tag');
        }
    }
}