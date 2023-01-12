<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_tracking extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getCourses(){
        return $this->hasOne(Course::class, 'id', 'course_id')->with(['getTutorName','getCategoryName','getCourseStatus']);
    }
}
