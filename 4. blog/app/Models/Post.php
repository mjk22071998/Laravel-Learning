<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['title', 'body'];

    protected $guarded = [];

}