<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Chat;
use Inertia\Inertia;

class ChatController extends Controller
{
    public function index(){

        $chats = Chat::with('messages')->where('user_id', Auth::id())->get();

        return Inertia::render('Chat/index' , ['chats' => $chats]);
    }
}