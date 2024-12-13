<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'class_id'
    ];

    // A student belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A student belongs to a class
    public function studentClass()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    // A student has many subjects
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'student_subject');
    }
}