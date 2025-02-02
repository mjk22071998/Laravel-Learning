<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    
    // Mass assignable attributes
    protected $fillable = ['Message', 'chat_id', 'user_id', 'status', 'context'];

    // Message belongs to a chat
    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    // Message belongs to a user (sender)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}