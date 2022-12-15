<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offline_course;
use App\Models\Reservation;

class LectureController extends Controller
{
    public function offline_lectures()
    {
        return view('user.offline-lectures');
    }

    public function lecture_detail()
    {
        return view('user.lecture-detail');
    }

    public function offline_lecture_detail($id)
    {
        $course_info = Offline_course::with('getTutorName')->where('id', $id)->first();
        if ($course_info->video == 'youtube') {
            $video_url = explode('=', $course_info->video_url);
            $embedded_video_id = $video_url[1];
        }
        $reservation = Reservation::where('course_id', $id)->where('user_id', auth()->id())->first();
        return view('user.offline-lecture-detail', compact('reservation', 'course_info', 'embedded_video_id'));
    }

    public function my_classroom()
    {
        return view('user.my-classroom');
    }
}
