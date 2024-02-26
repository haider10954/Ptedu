<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offline_enrollment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getCousreName()
    {
    return $this->hasOne(Offline_course::class , 'id', 'course_id');
    }

    public function getUser()
    {
        return $this->hasOne(User::class , 'id', 'user_id');
    }
}
