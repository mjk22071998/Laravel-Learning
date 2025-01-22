<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PagesController extends Controller
{
    public function getAbout(){
        return view('pages.about');
    }

    public function getContact(){
        return view('pages.contact');
    }

    public function getIndex(){
        $posts = Post::orderBy('created_at', 'desc')->take(5)->get();

        return view('pages.welcome',compact('posts'));
    }
}