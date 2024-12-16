<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $fillable = [
        "name"
    ];

    // A class has many students
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}