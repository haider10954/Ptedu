<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_lecture extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'lecture_videos' => 'array',
    ];

    
}

