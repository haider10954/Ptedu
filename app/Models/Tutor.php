<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getTutorImage()
    {
        return asset('storage/tutor/' . $this->tutor_img);
    }

    public function getCourseName()
    {
        return $this->hasMany(Course::class, 'tutor_id', 'id');
    }
}
