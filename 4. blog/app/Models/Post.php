<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'body', 'slug', 'user_id', 'cat_id'];

    protected $casts = [
        'body'=> CleanHtml::class
    ];

    // Define the inverse relationship: Each post belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}