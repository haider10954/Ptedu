<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class Offline_course extends Model
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
        return asset('storage/offline_course/thumbnail/' . $this->course_thumbnail);
    }

    public function getCourseBanner()
    {
        return asset('storage/offline_course/banner/' . $this->course_banner);
    }

    public function getReservationWaiting()
    {
        return $this->hasMany(Reservation::class, 'course_id', 'id')->where('status', 'applied');
    }

    public function getReservationReserved()
    {
        return $this->hasMany(Reservation::class, 'course_id', 'id')->where('status', 'reserved');
    }

    public function getOfflineEnrollments()
    {
        return $this->hasMany(Offline_enrollment::class , 'course_id','id');
    }

    public function getNoOfFreeParticipants()
    {
        return $this->hasMany(Student_offline_price_control::class , 'course_id','id')->where('is_free',1);
    }
}
