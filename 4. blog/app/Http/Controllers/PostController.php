<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use \Exception;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(15);
        return view('posts.index', compact('posts'));
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

            // Generate a slug from the title
            $slug = Str::slug($validated['title']);

            // Check if the slug already exists in the database
            $slugCount = Post::where('slug', 'like', "$slug%")->count();

            // If the slug exists, append a number to make it unique
            if ($slugCount > 0) {
                $slug = $slug . '-' . ($slugCount + 1);
            }

            // Add the slug to the validated data
            $validated['slug'] = $slug;

            // Using mass assignment to create a post with the slug
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
    public function show(string $slug)
    {   try{
            $post = Post::where('slug', $slug)->firstOrFail();
            return view("posts.show", compact('post'));
        } catch (Exception $e) {
            // Returning the actual exception message
            return back()->withInput()->with('error', 'Something went wrong. Error: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        try {
            $post = Post::where('slug', $slug)->firstOrFail();
            return view("posts.edit", compact('post'));
        } catch (Exception $e) {
            // Returning the actual exception message
            return back()->withInput()->with('error', 'Something went wrong. Error: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
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

            // Find the post by ID or fail if not found
            $post = Post::where('slug', $slug)->firstOrFail();

            // Generate the new slug
            $slug = Str::slug($validated['title']);

            // Check if the slug already exists in the database and make it unique
            $slugCount = Post::where('slug', 'like', "$slug%")->where('id', '<>', $post->id)->count();
            if ($slugCount > 0) {
                $slug = $slug . '-' . ($slugCount + 1);
            }

            // Update the post with the new title, body, and slug
            $post->update([
                'title' => $validated['title'],
                'body' => $validated['body'],
                'slug' => $slug, // Updating the slug
            ]);

            // Redirect to the post show page with success message
            return redirect()->route('post.show', $post->id)->with('success', 'Post updated successfully');
        } catch (Exception $e) {
            // Returning the actual exception message
            return back()->withInput()->with('error', 'Something went wrong. Error: ' . $e->getMessage());
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        try {
            // Find the post by ID or fail if not found
            $post = Post::where('slug', $slug)->firstOrFail();

            // Delete the post
            $post->delete();

            // Redirect to the posts list with success message
            return redirect()->route('post.index')->with('success', 'Post deleted successfully');
        } catch (Exception $e) {
            // Returning the actual exception message
            return back()->with('error', 'Something went wrong. Error: ' . $e->getMessage());
        }
    }

}