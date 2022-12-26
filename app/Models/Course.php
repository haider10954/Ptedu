<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getCategoryName()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function getTutorName()
    {
        return $this->hasOne(Tutor::class, 'id', 'tutor_id');
    }

    public function getCourseThumbnail()
    {
        return asset('storage/course/thumbnail/' . $this->course_thumbnail);
    }

    public function getCourseBanner()
    {
        return asset('storage/course/banner/' . $this->course_banner);
    }

    public function getCourseStatus()
    {
        return $this->hasMany(Section::class, 'course_id', 'id')->with('getLectures');
    }
}
