<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Course_lecture;
use App\Models\Section;
use Illuminate\Http\Request;

class CourseLectureController extends Controller
{
    function upload_video($file)
    {
        if(!file_exists(storage_path('app/public/course/lectures')))
        {
            mkdir(storage_path('app/public/course/lectures'),0755);
        }
        $fileName =  time() . mt_rand(300, 9000) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/course/lectures', $fileName);
        $loadPath = storage_path('app/public/') . '/' . $fileName;
        return $fileName;
    }
    public function course_lecture_listing($id)
    {
        $section = Section::where('id', $id)->first();
        $lecture = Course_lecture::where('course_section_id', $id)->get();
        return view('admin.course_lectures.lecture', compact('section', 'lecture'));
    }

    public function add_course_lecture_view($id)
    {

        $section = Section::where('id', $id)->first();
        return view('admin.course_lectures.add_lecture', compact('section'));
    }

    public function add_course_lecture(Request $request)
    {
        $lecture_videos_arr = [];
        foreach ($request->lecture_videos as $value) {
            $lecture_videos_arr[$value['lecture_title']] =  $this->upload_video($value['lecture_video']);
        }

        $lecture = Course_lecture::create([
            'course_section_id' => $request['id'],
            'lecture_videos' => $lecture_videos_arr,
        ]);
        if ($lecture) {
            return redirect()->back()->with('msg', 'Course Lecture has been Added Successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong Please try again.');
        }
    }

    public function delete_course_lecture(Request $request)
    {
        $lecture = Course_lecture::where('id', $request['id'])->delete();
        if ($lecture) {
            return redirect()->back()->with('msg', 'Course Lecture has been deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong Please try again.');
        }
    }
}
