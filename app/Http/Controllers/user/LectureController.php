<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offline_course;
use App\Models\Course;
use App\Models\Offline_enrollment;
use App\Models\Reservation;
use App\Models\Online_enrollment;
use App\Models\Course_tracking;
use App\Models\Like_course;
use App\Models\Review;
use App\Service\VideoHandler;

class LectureController extends Controller
{
    public function offline_lectures()
    {
        $offline_courses = Offline_course::with('getTutorName')->paginate(8);
        return view('user.offline-lectures', compact('offline_courses'));
    }

    public function lecture_detail()
    {
        return view('user.lecture-detail');
    }

    public function offline_lecture_detail($id)
    {
        $course_info = Offline_course::with('getTutorName')->where('id', $id)->first();
        if (!empty($course_info)) {
            $video_handler = new VideoHandler();
            $video_info =  $video_handler->getVideoInfo($course_info->video_url);
            if ($video_info != false) {
                $embedded_video_url = $video_info->html;
            } else {
                $embedded_video_url = false;
            }
            $reservation = Reservation::where('course_id', $id)->where('user_id', auth()->id())->first();
            $offline_enrollment_count = Offline_enrollment::where('course_id', $id)->count();
            $enrolled_user = Offline_enrollment::where('course_id', $id)->where('user_id', auth()->id())->count();

            //Liked Courses

            $liked_course = Like_course::where('course_id', $id)->where('type', 'offline')->first();

            return view('user.offline-lecture-detail', compact('reservation', 'course_info', 'embedded_video_url', 'offline_enrollment_count', 'enrolled_user', 'liked_course'));
        }
        else
        {
            abort(404);
        }
    }

    public function my_classroom(Request $request)
    {

        $categories = [];
        $courses = Course_tracking::where('user_id', auth()->id())->with('getCourses')->get();
        $completed_courses = $courses->where('status', 1);
        $courses_enrolled = $courses->where('status', 0);
        $offline_enrolments = Offline_enrollment::where('user_id', auth()->id())->with('getCousreName')->get();
        $reservations = Reservation::where('user_id', auth()->id())->with('getCourses')->get();
        foreach ($courses as $v) {
            if (!in_array($v->getCourses->category_id, $categories)) {
                array_push($categories, $v->getCourses->category_id);
            }
        }
        $related_courses = Course::with(['getCategoryName', 'getTutorName', 'getCourseStatus'])->whereIn('category_id', $categories)->get();
        $reviews =  Review::where('user_id', auth()->id())->where('course_id', $request->course_id)->count();
        // dd($request->course_id);

        //Liked Courses 

        $liked_courses = Like_course::query()->where('user_id', auth()->id())->with('getLikedCourse')->latest()->get();

        return view('user.my-classroom', compact('courses_enrolled', 'completed_courses', 'related_courses', 'reviews', 'offline_enrolments', 'reservations', 'liked_courses'));
    }

    public function online_course_detail($id)
    {
        $course_info = Course::with(['getTutorName', 'getCategoryName'])->where('id', $id)->first();

        if (!empty($course_info)) {
            // dd($course_info);
            $video_handler = new VideoHandler();
            $video_info =  $video_handler->getVideoInfo($course_info->video_url);
            if ($video_info != false) {
                $embedded_video_url = $video_info->html;
            } else {
                $embedded_video_url = false;
            }
            $reservation = Reservation::where('course_id', $id)->where('user_id', auth()->id())->first();
            $reviews = Review::where('course_id', $id)->get();

            //Liked Courses

            $liked_course = Like_course::where('course_id', $id)->where('type', 'online')->where('user_id', auth()->id())->first();

            return view('user.online-course-detail', compact('reservation', 'course_info', 'embedded_video_url', 'reviews', 'liked_course'));
        } else {
            abort(404);
        }
    }

    public function lecture_video()
    {
        return view('user.lecture-video');
    }

    public function enrol_course($id)
    {
        $check_enrollment = Online_enrollment::where('course_id', $id)->where('user_id', auth()->id())->first();
        if (!empty($check_enrollment)) {
            return 'Already Enrolled';
        }
        $course = Course::where('id', $id)->with('getCourseStatus')->first();
        $lecture_count = 0;
        if ($course->getCourseStatus->count() > 0) {
            foreach ($course->getCourseStatus as $value) {
                $lecture_count = $lecture_count + $value->getLectures->count();
            }
        }
        $enrollment = Online_enrollment::create([
            'course_id' => $id,
            'user_id' => auth()->id()
        ]);
        if ($enrollment) {
            $course_tracking = Course_tracking::create([
                'course_id' => $id,
                'user_id' => auth()->id(),
                'no_of_lectures' => $lecture_count,
                'viewed_lectures' => 0
            ]);
            if ($course_tracking) {
                return 'Enrolled Successfully';
            }
        }
    }

    public function online_courses_listing()
    {
        $online_courses = Course::paginate(8);
        return view('user.online-courses', compact('online_courses'));
    }
}
