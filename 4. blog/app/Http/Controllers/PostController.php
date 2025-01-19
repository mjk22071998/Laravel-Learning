<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use \Exception;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validating data
            $validated = $request->validate([
                'title' => 'required|max:100',
                'body' => ['required', function ($attribute, $value, $fail) {
                    $wordCount = str_word_count(strip_tags($value));
                    if ($wordCount < 100) {
                        $fail("The $attribute must have at least 100 words. Current word count: $wordCount.");
                    }
                }],
            ]);

            // Using mass assignment to create a post
            $post = Post::create($validated);

            // Redirect to the post show page with success message
            return redirect()->route('post.show', $post->id)->with('success', 'Post created successfully');
        } catch (Exception $e) {
            // Returning the actual exception message
            return back()->withInput()->with('error', 'Something went wrong. Error: ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        return view("posts.show", compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}