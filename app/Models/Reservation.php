<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Offline_course;

class Reservation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getUser()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function getCourses()
    {
        return $this->hasOne(Offline_course::class, 'id', 'course_id');
    }

    public function getStatus()
    {
        if ($this->status == 'applied') {
            return 'warning';
        }
        if ($this->status == 'reserved') {
            return 'success';
        }
        if ($this->status == 'decline') {
            return 'danger';
        }
    }
}
