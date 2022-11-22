<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Tutor;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function course_listing()
    {
        $course = Course::get();
        return view('admin.courses.course', compact('course'));
    }

    public function add_course_view()
    {
        $tutor = Tutor::get();
        $category = Category::get();
        return view('admin.courses.add_course', compact('tutor', 'category'));
    }

    function upload_files($file)
    {
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/course/thumbnail', $fileName);
        $loadPath = storage_path('app/public/') . '/' . $fileName;
        return $fileName;
    }

    function upload_files_banner($file)
    {
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/course/banner', $fileName);
        $loadPath = storage_path('app/public/') . '/' . $fileName;
        return $fileName;
    }

    function video_file($file)
    {
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/course/video', $fileName);
        $loadPath = storage_path('app/public/') . '/' . $fileName;
        return $fileName;
    }


    public function add_course(Request $request)
    {
        $this->validate($request, [
            'course_title' => 'required',
            'tutor_name' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'no_of_lectures' => 'required|min:0',
            'course_duration' => 'required',
            'price' => 'required|min:0',
            'discounted_Price' => 'required|min:0',
            'category' => 'required',
            'video_url' => 'required',
            'video' => 'required|mimes:mp4',
            'course_img' => 'required|mimes:jpeg,png,jpg',
            'banner_img' => 'required|mimes:jpeg,png,jpg',
        ]);

        $course_video = $this->upload_files($request['video']);
        $course_thumbnail = $this->upload_files($request['course_img']);
        $course_banner = $this->upload_files($request['banner_img']);

        $course = Course::create([
            'tutor_id' => $request['tutor_name'],
            'category_id' => $request['category'],
            'course_title' => $request['course_title'],
            'short_description' => $request['short_description'],
            'description' => $request['description'],
            'no_of_lectures' => $request['no_of_lectures'],
            'duration_of_course' => $request['course_duration'],
            'price' => $request['price'],
            'discounted_prize' => $request['discounted_Price'],
            'video_url' => $request['video_url'],
            'video' => $course_video,
            'course_thumbnail' => $course_thumbnail,
            'course_banner' => $course_banner
        ]);

        if ($course) {
            return json_encode([
                'success' => true,
                'message' => 'Course has been added successfully.'
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => 'Something went wrong Please try again.'
            ]);
        }
    }
}
