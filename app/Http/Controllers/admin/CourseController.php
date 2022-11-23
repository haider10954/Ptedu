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
        $course = Course::paginate(3);
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
        $fileName =  time() . mt_rand(300, 9000) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/course/thumbnail', $fileName);
        $loadPath = storage_path('app/public/') . '/' . $fileName;
        return $fileName;
    }

    function upload_files_banner($file)
    {
        $fileName = time() . mt_rand(300, 9000) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/course/banner', $fileName);
        $loadPath = storage_path('app/public/') . '/' . $fileName;
        return $fileName;
    }

    public function add_course(Request $request)
    {
        $request->validate([
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
            'video' => 'required',
            'course_img' => 'required|mimes:jpeg,png,jpg',
            'banner_img' => 'required|mimes:jpeg,png,jpg',
        ]);
        $course_thumbnail = $this->upload_files($request['course_img']);
        $course_banner = $this->upload_files_banner($request['banner_img']);
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
            'video' => $request['video'],
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

    public function delete_course(Request $request)
    {
        $course = Course::where('id', $request->id)->first();
        $filePath = storage_path('app/public/course/thumbnail/' . $course->course_thumbnail);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $filePath2 = storage_path('app/public/course/banner/' . $course->course_banner);
        if (file_exists($filePath2)) {
            unlink($filePath2);
        }
        $course = Course::where('id', $request['id'])->delete();
        if ($course) {
            return redirect()->back()->with('msg', 'Course has been deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong Please try again.');
        }
    }

    public function edit_course_view($id)
    {
        $course = Course::where('id', $id)->first();
        $tutor = Tutor::get();
        $category = Category::get();
        return view('admin.courses.edit_course', compact('course', 'tutor', 'category'));
    }

    public function edit_course(Request $request)
    {
        $request->validate([
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
            'video' => 'required',
            'course_img' => 'mimes:jpeg,png,jpg',
            'banner_img' => 'mimes:jpeg,png,jpg',
        ]);

        if ($request->hasFile('course_img')) {
            $data['course_thumbnail'] = $this->upload_files($request['course_img']);
        }

        if ($request->hasFile('banner_img')) {
            $data['course_banner'] = $this->upload_files_banner($request['banner_img']);
        }

        $data['tutor_id'] = $request['tutor_name'];
        $data['category_id'] = $request['category'];
        $data['course_title'] = $request['course_title'];
        $data['short_description'] = $request['short_description'];
        $data['description'] = $request['description'];
        $data['no_of_lectures'] = $request['no_of_lectures'];
        $data['duration_of_course'] = $request['course_duration'];
        $data['price'] = $request['price'];
        $data['discounted_prize'] = $request['discounted_Price'];
        $data['video_url'] = $request['video_url'];
        $data['video'] = $request['video'];

        $course = Course::where('id', $request->id)->update($data);

        if ($course) {
            return json_encode([
                'success' => true,
                'message' => 'Course has been updated successfully.'
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => 'Something went wrong Please try again.'
            ]);
        }
    }
}
