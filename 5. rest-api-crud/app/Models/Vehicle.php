<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'model',
        'year',
        'color',
        'price'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'vehicle_assignment');
    }

    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }
}