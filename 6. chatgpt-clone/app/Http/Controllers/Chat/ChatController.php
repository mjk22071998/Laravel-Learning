<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ChatController extends Controller
{
    public function index(string $id = null){
        Log::debug('inside');
        return Inertia::render('Chat/index', compact("id"));
    }
}