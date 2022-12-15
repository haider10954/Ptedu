<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offline_course;
use App\Models\Reservation;
use App\Service\VideoHandler;

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
        $video_handler = new VideoHandler();
		$video_info =  $video_handler->getVideoInfo( $course_info->video_url );
        $embedded_video_url = $video_info->html;
        $reservation = Reservation::where('course_id', $id)->where('user_id', auth()->id())->first();
        return view('user.offline-lecture-detail', compact('reservation', 'course_info', 'embedded_video_url'));
    }

    public function my_classroom()
    {
        return view('user.my-classroom');
    }
}
