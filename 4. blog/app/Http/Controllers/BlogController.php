<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use \Exception;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function getSingle(string $slug)
    {
        try {
            $post = Post::where('slug', $slug)
                ->with('comments')  // Eager load the comments
                ->firstOrFail();
            
            return view('blog.single', compact('post'));
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Something went wrong. Error: ' . $e->getMessage());
        }
    }

    public function getIndex()
    {
        $posts = Post::latest()->paginate(10);
        return view('blog.index', compact('posts'));
    }

    public function postComment(Request $request, $postId)
    {
        // Validate the comment input
        $request->validate([
            'body' => 'required|max:1000',
        ]);

        // Find the post
        $post = Post::findOrFail($postId);

        // Create a new comment and fill it with validated data
        $comment = new Comment();
        $comment->fill([
            'body' => $request->body,
            'post_id' => $post->id,
            'user_id' => Auth::check() ? Auth::id() : null, // Set user_id if logged in, otherwise null for anonymous comments
        ]);

        // Save the comment to the database
        $comment->save();

        // Redirect back to the post page with a success message
        return back()->with('success', 'Comment added successfully!');
    }


    public function deleteComment($commentId)
    {
        try {
            // Find the comment by ID
            $comment = Comment::findOrFail($commentId);

            // Check if the authenticated user is the one who posted the comment
            if (Auth::id() === $comment->user_id) {
                // Delete the comment
                $comment->delete();

                return back()->with('success', 'Comment deleted successfully.');
            } else {
                return back()->with('error', 'You can only delete your own comments.');
            }
        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong. Error: ' . $e->getMessage());
        }
    }

}