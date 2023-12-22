<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_offline_price_control extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getCourses(){
        return $this->belongsTo(Offline_course::class, 'course_id', 'id');
    }

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
