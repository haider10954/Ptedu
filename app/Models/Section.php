<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getLectures()
    {
        return $this->hasMany(Lecture::class, 'section_id', 'id')->with('getLogRecord');
    }

    public function getCourse()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }
}
