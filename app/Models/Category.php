<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getCourses()
    {
        return $this->hasMany(Course::class, 'category_id', 'id');
    }

    public function getOffineCourses()
    {
        return $this->hasMany(Offline_course::class, 'category_id', 'id');
    }

    public function getReviews()
    {
        return $this->hasMany(Review::class, 'categroy_id', 'id');
    }
}
