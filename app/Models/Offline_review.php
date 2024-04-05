<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offline_review extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['type'];

    public function getCousreName()
    {
        return $this->HasOne(Offline_course::class, 'id', 'course_id');
    }

    public function getUser()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getTypeAttribute()
    {
        return 'Offline';
    }
}
