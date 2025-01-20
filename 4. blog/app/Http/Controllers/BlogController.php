<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use \Exception;

class BlogController extends Controller
{
    public function getSingle(string $slug)
    {
        try {
            $post = Post::where('slug', $slug)->firstOrFail();
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
}