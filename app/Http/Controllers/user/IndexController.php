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
    public function index()
    {
        $offline_courses = Offline_course::with('getTutorName')->get();
        $courses = Course::get();
        $latest_courses = Course::orderBy('id', 'desc')->with('getTutorName')->take(5)->get();
        $latest_tutors = Tutor::orderBy('id', 'desc')->take(8)->get();
        $latest_reviews = Review::orderBy('id', 'desc')->get();

        if ($latest_reviews->count() > 0) {
            for ($i = 0; $i <  $latest_reviews->count(); $i++) {
                if (!empty($latest_reviews[$i]->video_url) || !empty($latest_reviews[$i]->video)) {
                    if (empty($latest_reviews[$i]->video_url)) {
                        $embedded_video = '<video src="' . asset('storage/review/video') . '/' . $latest_reviews[$i]->video . '" controls height="300" width="300"></video>';
                    }

                    if (empty($latest_reviews[$i]->video)) {
                        $video_handler = new VideoHandler();
                        $video_url = $video_handler->getVideoInfo($latest_reviews[$i]->video_url);
                        $embedded_video = $video_url->html;
                    }

                    if (!empty($latest_reviews[$i]->video_url) && !empty($latest_reviews[$i]->video)) {
                        $video_handler = new VideoHandler();
                        $video_url = $video_handler->getVideoInfo($latest_reviews[$i]->video_url);
                        $embedded_video = $video_url->html;
                    }
                }
            }
        } else {
            $embedded_video = "";
        }

        return view('user.index', compact('offline_courses', 'courses', 'latest_courses', 'latest_tutors', 'latest_reviews', 'embedded_video'));
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
