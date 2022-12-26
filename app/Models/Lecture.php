<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getSection()
    {
        return $this->hasOne(Section::class, 'id', 'section_id')->with('getCourse');
    }

    public function getLogRecord()
    {
        return $this->hasMany(Student_log::class, 'lecture_id', 'id');
    }
}
