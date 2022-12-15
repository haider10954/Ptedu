<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Section;
use App\Models\Tutor;
use App\Models\Lecture;
use Illuminate\Http\Request;
use Owenoj\LaravelGetId3\GetId3;
use App\Service\VideoHandler;

class CourseController extends Controller
{
    public function course_listing()
    {
        $course = Course::paginate(10);
        return view('admin.courses.course', compact('course'));
    }

    public function add_course_view()
    {
        $tutor = Tutor::get();
        $category = Category::get();
        return view('admin.courses.add_course', compact('tutor', 'category'));
    }

    public function add_courses_view()
    {
        $tutor = Tutor::get();
        $category = Category::get();
        return view('admin.courses.add_courses', compact('tutor', 'category'));
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

    function upload_lecture_video($file)
    {
        $fileName =  time() . mt_rand(300, 9000) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/lectures', $fileName);
        $loadPath = storage_path('app/public/') . '/' . $fileName;
        return $fileName;
    }

    public function add_course(Request $request)
    {
        $request->validate([
            'course_type' => 'required',
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
            'category' => 'required',
            'course_type' => 'required',
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
            'course_banner' => $course_banner,
            'course_type' => $request['course_type'],
        ]);

        if ($course) {
            return json_encode([
                'success' => true,
                'message' => 'Course has been added successfully.',
                'course_id' => $course->id
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => 'Something went wrong Please try again.'
            ]);
        }
    }
    
    public function add_sections(Request $request){
        $validate = \Validator::make($request->all(),[
            'course_sections.*.section_title' => 'required',
            'course_sections.*.section_description' => 'required'
        ]);

        if($validate->fails())
        {
            return response()->json(['error' => true , 'errors' => $validate->errors()->first()]);
        }

        $sections = collect($request->course_sections)->map(function($item) use ($request){
            $item['course_id'] = $request->course_id; 
            return $item;
        });
        $sectionQuery = Section::insert($sections->toArray());
        if ($sectionQuery){
            $getSections = Section::where('course_id', $request->course_id)->get();
            return json_encode([
                'success' => true,
                'sections' => $getSections
            ]);
        }
    }

    public function add_lectures(Request $request){
        $validate = \Validator::make($request->all(),[
            'section_lectures.*.lecture_title' => 'required',
            'section_lectures.*.lecture_video' => 'required'
        ]);

        if($validate->fails())
        {
            return response()->json(['error' => true , 'errors' => $validate->errors()->first()]);
        }

        $lectures = $request->section_lectures;

        for ($i=0; $i < count($lectures); $i++) {
            $track = new GetId3($lectures[$i]['lecture_video']); 
            $video_uploaded = $this->upload_lecture_video($lectures[$i]['lecture_video']);
            $lectures[$i]['duration'] = $track->getPlaytime();
            $lectures[$i]['section_id'] = $request->section_id;
            $lectures[$i]['lecture_video'] = $video_uploaded;
        }   

        $lectureQuery = Lecture::insert($lectures);
        if ($lectureQuery){
            $getLectures = Lecture::where('section_id', $request->section_id)->get();
            return json_encode([
                'success' => true,
                'lectures' => $getLectures
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
        $section = Section::where('course_id', $id)->get();
        return view('admin.courses.edit_course', compact('course', 'tutor', 'category', 'section'));
    }

    public function edit_course(Request $request)
    {
        $request->validate([
            'course_type' => 'required',
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

        $data['course_type'] = $request['course_type'];
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
