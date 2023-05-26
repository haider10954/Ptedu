<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like_course extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getLikedCourse()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }

    public function getOfflineLikedCourse()
    {
        return $this->hasOne(Offline_course::class, 'id', 'course_id');
    }
}
