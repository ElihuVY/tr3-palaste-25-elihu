<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectRequest extends Model
{
    protected $fillable = [
        'name', 
        'email', 
        'phone', 
        'address', 
        'project_type', 
        'description', 
        'budget', 
        'timeline', 
        'stairs_details', 
        'railings_details', 
        'doors_details', 
        'other_details', 
        'files',
        'user_id'
    ];

    // Convertir campos JSON a arrays
    protected $casts = [
        'stairs_details' => 'array',
        'railings_details' => 'array',
        'doors_details' => 'array',
        'other_details' => 'array',
        'files' => 'array'
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}
}