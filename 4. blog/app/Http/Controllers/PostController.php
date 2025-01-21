<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use \Exception;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = request()->user()->posts()->paginate(15);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(); // get all categories
        return view('posts.create', compact('categories'));
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
                'cat_id' => 'required|exists:categories,id', // Ensure category ID exists
            ]);

            // Generate a slug from the title
            $slug = Str::slug($validated['title']);

            // Check if the slug already exists in the database
            $slugCount = Post::where('slug', 'like', "$slug%")->count();

            // If the slug exists, append a number to make it unique
            if ($slugCount > 0) {
                $slug = $slug . '-' . ($slugCount + 1);
            }

            // Add the slug and associate the post with the authenticated user
            $validated['slug'] = $slug;
            $validated['user_id'] = $request->user()->id;

            // Create the post
            $post = Post::create($validated);

            // Redirect with success message
            return redirect()->route('post.show', $post->id)->with('success', 'Post created successfully');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Something went wrong. Error: ' . $e->getMessage());
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            // Find the post by ID or fail if not found
            $post = Post::findOrFail($id);

            // Check if the post belongs to the authenticated user
            if ($post->user_id !== request()->user()->id) {
                // If the post doesn't belong to the user, redirect with an error message
                return redirect()->route('post.index')->with('error', 'You are not authorized to view this post.');
            }

            // If the post belongs to the user, display it
            return view("posts.show", compact('post'));
        } catch (Exception $e) {
            // Handle any exceptions
            return back()->with('error', 'Something went wrong. Error: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $post = Post::findOrFail($id);
            if ($post->user_id !== request()->user()->id) {
                // If the post doesn't belong to the user, redirect with an error message
                return redirect()->route('post.index')->with('error', 'You are not authorized to edit this post.');
            }
            return view("posts.edit", compact('post'));
        } catch (Exception $e) {
            // Returning the actual exception message
            return back()->withInput()->with('error', 'Something went wrong. Error: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
                'cat_id' => 'required|exists:categories,id', // Ensure category ID exists
            ]);

            // Find the post by ID
            $post = Post::findOrFail($id);

            // Check if the title is changed
            if ($post->title !== $validated['title']) {
                // Generate the new slug
                $slug = Str::slug($validated['title']);

                // Check if the slug already exists and make it unique
                $slugCount = Post::where('slug', 'like', "$slug%")->where('id', '<>', $post->id)->count();
                if ($slugCount > 0) {
                    $slug = $slug . '-' . ($slugCount + 1);
                }

                // Update the slug in the validated data
                $validated['slug'] = $slug;
            } else {
                // Keep the existing slug if the title hasn't changed
                $validated['slug'] = $post->slug;
            }

            // Update the post
            $post->update([
                'title' => $validated['title'],
                'body' => $validated['body'],
                'slug' => $validated['slug'], // Use the updated or existing slug
                'cat_id' => $validated['cat_id'], // Update the category ID
            ]);

            // Redirect with success message
            return redirect()->route('post.show', $post->id)->with('success', 'Post updated successfully');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Something went wrong. Error: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Find the post by ID or fail if not found
            $post = Post::findOrFail($id);

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