<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice;
use App\Models\Faq;
use App\Models\Offline_course;
use App\Models\Course;
use App\Models\Review;
use App\Models\Tutor;
use App\Service\VideoHandler;

class IndexController extends Controller
{
    //
    public function get_video_thumbnail(){
        $video_thumbnail = VideoHandler::getLocalVideoThumbnail(10 , asset('storage/lectures/16710031836563.mp4') , asset('storage/thumbnails/'.time().'.mp4') );
        dd($video_thumbnail);
    }

    public function index()
    {
        $offline_courses = Offline_course::with('getTutorName')->get();
        $courses = Course::get();
        $latest_courses = Course::orderBy('id', 'desc')->with('getTutorName')->take(5)->get();
        $latest_tutors = Tutor::take(4)->get();
        $reviews = Review::orderBy('id', 'desc')->get();
        foreach($reviews as $review){
            if(!empty($review->video_url)){
                $review['video_thumbnail'] = VideoHandler::getVideoThumbnail($review->video_url);
            }
        }
        return view('user.index', compact('offline_courses', 'courses', 'latest_courses', 'latest_tutors','reviews'));
    }

    public function notice()
    {
        $notices = Notice::orderBy('id', 'desc')->paginate(10);
        return view('user.notice', compact('notices'));
    }

    public function faq()
    {
        $faqs = Faq::paginate(10);
        return view('user.faq', compact('faqs'));
    }

    public function tutor_info($id)
    {
        $tutor = Tutor::where('id', $id)->with('getCourseName')->first();
        return view('user.tutor_info', compact('tutor'));
    }
}
