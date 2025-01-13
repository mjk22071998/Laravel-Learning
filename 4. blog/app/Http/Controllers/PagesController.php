<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function getAbout(){
        return view('pages.about');
    }

    public function getIndex(){
        return view('pages.welcome');
    }
}