<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Review extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['type'];

    public function getCourse()
    {
        return $this->HasOne(Course::class, 'id', 'course_id');
    }

    public function getUser()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getTypeAttribute()
    {
        return 'Online';
    }
}
