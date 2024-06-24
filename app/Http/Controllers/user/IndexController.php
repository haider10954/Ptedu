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
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //
    public function get_video_thumbnail()
    {
        $video_thumbnail = VideoHandler::getLocalVideoThumbnail(10, asset('storage/lectures/16710031836563.mp4'), asset('storage/thumbnails/' . time() . '.mp4'));
        dd($video_thumbnail);
    }

    public function index()
    {
        $offline_courses = Offline_course::orderBy('id', 'desc')->with('getTutorName')->get();
        $courses = Course::where('course_type','online')->orderBy('id', 'desc')->get();
        $special_course = Course::where('course_type', 'special')->get();
        $latest_courses = Course::orderBy('id', 'desc')->with('getTutorName')->take(5)->get();
        $latest_tutors = Tutor::take(4)->get();
        $reviews = Review::orderBy('id', 'desc')->get();
        foreach ($reviews as $review) {
            if (!empty($review->video_url)) {
                $review['video_thumbnail'] = VideoHandler::getVideoThumbnail($review->video_url);
            }
        }
        return view('user.index', compact('offline_courses', 'courses','special_course', 'latest_courses', 'latest_tutors', 'reviews'));
    }

    public function notice()
    {
        $notices = Notice::orderBy('id', 'desc')->paginate(10);
        return view('user.notice', compact('notices'));
    }

    public function notice_detail($id)
    {
        $notices = Notice::query()->where('id', $id)->first();

        // Update view count only if it's a unique visit
        $ipAddress = request()->ip();
        // $view = DB::table('notice_views')
        //     ->where('notice_id', $id)
        //     ->where('ip_address', $ipAddress)
        //     ->first();

        DB::table('notices')->where('id', $id)->increment('views');

        DB::table('notice_views')->insert([
            'notice_id' => $id,
            'ip_address' => $ipAddress,
        ]);

        // if (!$view) {
        //     // If IP address hasn't viewed the notice yet, increment the view count
        //     DB::table('notices')->where('id', $id)->increment('views');

        //     // Record the view
        //     DB::table('notice_views')->insert([
        //         'notice_id' => $id,
        //         'ip_address' => $ipAddress,
        //     ]);
        // }

        return view('user.notice_detail', compact('notices'));
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
