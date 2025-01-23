<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    protected $fillable = [
        'user_id', 'vehicle_id', 'inspection_date', 
        'steering', 'steering_attachment', 
        'brakes', 'brakes_attachment', 
        'lights', 'lights_attachment', 
        'tires', 'tires_attachment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}