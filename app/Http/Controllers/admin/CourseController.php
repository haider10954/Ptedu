<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Review;
use App\Models\Section;
use App\Models\Tutor;
use App\Models\Lecture;
use App\Models\Course_tracking;
use Illuminate\Http\Request;
use Owenoj\LaravelGetId3\GetId3;
use App\Service\VideoHandler;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    function delete_file($folder, $filename){
        if (Storage::disk('public')->exists($folder.'/' . $filename)) {
            Storage::disk('public')->delete($folder.'/' . $filename);
        }
    }
    public function course_listing()
    {
        $limit = 10;
        $page = 1;
        $totalRecords = Course::count();
        if (request()->has('page')) {
            $page = request()->get('page');
        }

        if ($totalRecords > $limit) {
            $counter = $totalRecords - (($page - 1) * $limit);
        } else {
            $counter = $totalRecords;
        }
        $course = Course::with(['getCourseStatus', 'getOnlineCourseEnrollment'])->paginate(10);
        return view('admin.courses.course', compact('course','counter'));
    }

    public function add_course_view()
    {
        $tutor = Tutor::query()->get();
        $category = Category::query()->where('type','online')->get();
        return view('admin.courses.add_course', compact('tutor', 'category'));
    }

    public function add_courses_view()
    {
        $tutor = Tutor::query()->get();
        $category = Category::query()->where('type','online')->get();
        return view('admin.courses.add_courses', compact('tutor', 'category'));
    }

    function upload_files($file)
    {
        if (!file_exists(storage_path('app/public/course/thumbnail'))) {
            mkdir(storage_path('app/public/course/thumbnail'), 0755, true);
        }
        $fileName = time() . mt_rand(300, 9000) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/course/thumbnail', $fileName);
        $loadPath = storage_path('app/public/') . '/' . $fileName;
        return $fileName;
    }

    function upload_files_banner($file)
    {

        if (!file_exists(storage_path('app/public/course/banner'))) {
            mkdir(storage_path('app/public/course/banner'), 0755, true);
        }
        $fileName = time() . mt_rand(300, 9000) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/course/banner', $fileName);
        $loadPath = storage_path('app/public/') . '/' . $fileName;
        return $fileName;
    }

    function upload_lecture_video($file)
    {
        if (!file_exists(storage_path('app/public/lectures'))) {
            mkdir(storage_path('app/public/lectures'), 0755, true);
        }
        $fileName = time() . mt_rand(300, 9000) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/lectures', $fileName);
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
            'category' => 'required',
            'video_url' => 'required',
            'course_type' => 'required',
            'course_img' => 'required|mimes:jpeg,png,jpg',
            'banner_img' => 'required|mimes:jpeg,png,jpg',
            'course_scheduling' => 'array',
            'course_scheduling.*' => 'required',
        ],[
            'course_scheduling.*.required' => 'course_scheduling 이름을 입력해주세요.',
        ]);

        $course_thumbnail = $this->upload_files($request['course_img']);
        $course_banner = $this->upload_files_banner($request['banner_img']);
        $course_schedule = json_encode($request->course_scheduling);
        $course = Course::query()->create([
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
            'course_thumbnail' => $course_thumbnail,
            'course_banner' => $course_banner,
            'course_type' => $request['course_type'],
            'course_schedule' => $course_schedule
        ]);

        if ($course) {
            return json_encode([
                'success' => true,
                'message' => __('translation.Course has been added successfully'),
                'course_id' => $course->id
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => __('translation.Something went wrong Please try again')
            ]);
        }
    }

    public function add_sections(Request $request)
    {
        $validate = \Validator::make($request->all(), [
            'course_sections.*.section_title' => 'required',
            'course_sections.*.section_description' => 'required'
        ]);

        if ($validate->fails()) {
            return response()->json(['error' => true, 'errors' => $validate->errors()->first()]);
        }

        $sections = collect($request->course_sections)->map(function ($item) use ($request) {
            $item['course_id'] = $request->course_id;
            return $item;
        });

        $sectionQuery = Section::insert($sections->toArray());
        if ($sectionQuery) {
            $getSections = Section::where('course_id', $request->course_id)->get();
            return json_encode([
                'success' => true,
                'sections' => $getSections
            ]);
        }
    }

    public function get_duration($video_id)
    {
        // $url = "https://vimeo.com/".$video_id;
        // $duration = VideoHandler::getYoutubeDuration($video_id);
        // $video_duration = VideoHandler::covtime($duration);
        $video_duration = VideoHandler::vimeoVideoDuration($video_id);
        dd($video_duration);
    }

    public function add_lectures(Request $request)
    {
        $validate = \Validator::make($request->all(), [
            'section_lectures.*.lecture_title' => 'required',
            'section_lectures.*.lecture_video_link' => 'nullable|url',
        ], [
            'section_lectures.*.lecture_video_link.url' => __('translation.Please enter a valid Url'),
            'section_lectures.*.lecture_title.required' => __('translation.Please enter lecture title'),
        ]);

        // $validate = \Validator::make($request->all(), [
        //     'section_lectures.*.lecture_title' => 'required',
        //     'section_lectures.*.lecture_video' => 'nullable|required_without:section_lectures.*.lecture_video_link|mimes:mp4',
        //     'section_lectures.*.lecture_video_link' => 'nullable|required_without:section_lectures.*.lecture_video|url',
        // ], [
        //     'section_lectures.*.lecture_video_link.required_without' => __('translation.Please upload lecture video or attach lecture video link'),
        //     'section_lectures.*.lecture_video.required_without' => __('translation.Please upload lecture video or attach lecture video link'),
        //     'section_lectures.*.lecture_video_link.url' => __('translation.Please enter a valid Url'),
        //     'section_lectures.*.lecture_video.mimes' => __('translation.Only mp4 video format is supported'),
        //     'section_lectures.*.lecture_title.required' => __('translation.Please enter lecture title'),
        // ]);

        if ($validate->fails()) {
            return response()->json(['error' => true, 'errors' => $validate->errors()->first()]);
        }

        $lectures = $request->section_lectures;

        for ($i = 0; $i < count($lectures); $i++) {
            if (isset($lectures[$i]['lecture_video'])) {
                $track = new GetId3($lectures[$i]['lecture_video']);
                $video_uploaded = $this->upload_lecture_video($lectures[$i]['lecture_video']);
                $lectures[$i]['duration'] = $track->getPlaytime();
                $lectures[$i]['section_id'] = $request->section_id;
                $lectures[$i]['lecture_video'] = $video_uploaded;
                $lectures[$i]['slug'] = \Str::slug($lectures[$i]['lecture_title'] . '-' . \Str::random(5, true));
            } else {
                $lectures[$i]['lecture_video'] = null;
                $lectures[$i]['duration'] = null;
                $lectures[$i]['section_id'] = $request->section_id;
                $lectures[$i]['slug'] = \Str::slug($lectures[$i]['lecture_title'] . '-' . \Str::random(5, true));
            }
            if (!isset($lectures[$i]['lecture_video_link'])) {
                $lectures[$i]['lecture_video_link'] = null;
                $lectures[$i]['section_id'] = $request->section_id;
                $lectures[$i]['slug'] = \Str::slug($lectures[$i]['lecture_title'] . '-' . \Str::random(5, true));
            }
            if (!isset($lectures[$i]['lecture_video']) && isset($lectures[$i]['lecture_video_link'])) {
                if (preg_match('|^http(s)?://(.*?)vimeo.com|', $lectures[$i]['lecture_video_link'])) {
                    $provider = 'vimeo';
                    $video_url_params = parse_url($lectures[$i]['lecture_video_link']);
                    $video_id = str_replace('/', '', $video_url_params['path']);
                    $video_duration = VideoHandler::vimeoVideoDuration($video_id);
                    $lectures[$i]['duration'] = $video_duration;
                } else {
                    $provider = 'youtube';
                    $video_url_params = parse_url($lectures[$i]['lecture_video_link']);
                    parse_str($video_url_params['query'], $params);
                    $video_id = $params['v'];
                    $duration = VideoHandler::getYoutubeDuration($video_id);
                    $video_duration = VideoHandler::covtime($duration);
                    $lectures[$i]['duration'] = $video_duration;
                }
            }
        }

        $lectureQuery = Lecture::insert($lectures);
        if ($lectureQuery) {
            $getLectures = Lecture::where('section_id', $request->section_id)->get();
            return json_encode([
                'success' => true,
                'lectures' => $getLectures
            ]);
        }
    }

    public function delete_course(Request $request)
    {
        $course = Course::query()->where('id', $request->id)->first();
        $filePath = storage_path('app/public/course/thumbnail/' . $course->course_thumbnail);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $filePath2 = storage_path('app/public/course/banner/' . $course->course_banner);
        if (file_exists($filePath2)) {
            unlink($filePath2);
        }
        // Get Course Reviews
        Review::query()->where('course_id',$request['id'])->delete();

        $course = Course::query()->where('id', $request['id'])->delete();
        if ($course) {
            return redirect()->back()->with('msg', __('translation.Offline Course has been deleted Successfully'));
        } else {
            return redirect()->back()->with('error', __('translation.Something went wrong Please try again'));
        }
    }

    public function edit_course_view($id)
    {
        // dd($id);
        $course = Course::where('id', $id)->first();
        $tutor = Tutor::query()->get();
        $category = Category::query()->where('type','online')->get();
        $sections = Section::with('getLectures')->where('course_id', $course->id)->get();
        return view('admin.courses.edit_courses', compact('tutor', 'category', 'course', 'sections'));
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
                'message' => __('translation.Course has been updated successfully')
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => __('translation.Something went wrong Please try again')
            ]);
        }
    }

    public function course_live_status(Request $request)
    {
        $validate = \Validator::make($request->all(), [
            'id' => 'required',
            'status' => 'required',
            'live_link' => 'required|url'
        ]);

        if ($validate->fails()) {
            return response()->json(['Success' => false, 'Message' => $validate->errors()->first()]);
        }

        $changeLiveStatus = Course::where('id', $request->id)->update([
            'live_link' => $request->live_link,
            'live_status' => $request->status
        ]);

        if ($changeLiveStatus) {
            return response()->json(['Success' => true, 'Message' => __('translation.Live Status changed')]);
        } else {
            return response()->json(['Success' => false, 'Message' => __('translation.Something went wrong Please try again')]);
        }
    }

    public function edit_course_action(Request $request)
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
            'discounted_Price' => 'min:0',
            'category' => 'required',
            'video_url' => 'required',
            'course_img' => 'mimes:jpeg,png,jpg',
            'banner_img' => 'mimes:jpeg,png,jpg',
            'course_scheduling.*' => "required",
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
        $data['course_schedule'] = json_encode($request->course_scheduling);

        $course = Course::where('id', $request->id)->update($data);

        if ($course) {
            return json_encode([
                'success' => true,
                'message' => __('translation.Course has been updated successfully')
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => __('translation.Something went wrong Please try again')
            ]);
        }
    }

    public function del_section(Request $request)
    {
        $sectionDelete = Section::where('id', $request->section_id)->delete();
        if ($sectionDelete) {
            $sections = Section::with('getLectures')->where('course_id', $request->course_id)->get();
            $html = view('admin.includes.section-boxes-view', compact('sections'))->render();
            return json_encode([
                'success' => true,
                'message' => __('translation.Section has been deleted successfully'),
                'html' => $html
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => __('translation.Something went wrong Please try again')
            ]);
        }
    }

    public function edit_section(Request $request)
    {
        $validate = \Validator::make($request->all(), [
            'section_title' => 'required',
            'section_description' => 'required'
        ]);
        if ($validate->fails()) {
            return json_encode([
                "success" => false,
                'message' => $validate->errors()->first()
            ]);
        }
        $sectionEdit = Section::where('id', $request->section_id)->update([
            'section_title' => $request->section_title,
            'section_description' => $request->section_description
        ]);
        if ($sectionEdit) {
            $sectionEdited = Section::where('id', $request->section_id)->first();
            $sections = Section::with('getLectures')->where('course_id', $request->course_id)->get();
            $html = view('admin.includes.section-boxes-view', compact('sections'))->render();
            return json_encode([
                'success' => true,
                'message' => __('translation.Section has been edited successfully'),
                'section' => $sectionEdited,
                'html' => $html
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => __('translation.Something went wrong Please try again')
            ]);
        }
    }

    public function add_single_section(Request $request)
    {
        $validate = \Validator::make($request->all(), [
            'section_title' => 'required',
            'section_description' => 'required'
        ]);
        if ($validate->fails()) {
            return json_encode([
                "success" => false,
                'message' => $validate->errors()->first()
            ]);
        }
        $sectionAdd = Section::create([
            'course_id' => $request->course_id,
            'section_title' => $request->section_title,
            'section_description' => $request->section_description
        ]);
        if ($sectionAdd) {
            $sections = Section::with('getLectures')->where('course_id', $request->course_id)->get();
            $html = view('admin.includes.section-boxes-view', compact('sections'))->render();
            return json_encode([
                'success' => true,
                'message' => __('translation.Section has been Added successfully'),
                'section' => $sectionAdd,
                'html' => $html
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => __('translation.Something went wrong Please try again')
            ]);
        }
    }

    public function add_single_lecture(Request $request)
    {
        $validate = \Validator::make($request->all(), [
            'lecture_title' => 'required',
            'lecture_video_link' => 'nullable|url',
        ], [
            'lecture_video_link.url' => __('translation.Please enter a valid Url'),
            'lecture_title.required' => __('translation.Please enter lecture title')
        ]);

        if ($validate->fails()) {
            return response()->json(['Success' => false, 'Msg' => $validate->errors()->first()]);
        }

        try {
            DB::beginTransaction();
            $video_uploaded = null;
        $slug = \Str::slug($request->lecture_title . '-' . \Str::random(5, true));
        $video_link = null;

        if ((isset($request->lecture_video)) && (!isset($request->lecture_video_link))) {
            if(empty($request->lecture_video_name)){
                $video_uploaded = $this->upload_lecture_video($request->lecture_video);
                $duration = $request->lecture_video_duration;
            }
        } else if ((!isset($request->lecture_video)) && (isset($request->lecture_video_link))) {
            $video_link = $request->lecture_video_link;
            if (preg_match('|^http(s)?://(.*?)vimeo.com|', $request->lecture_video_link)) {
                $provider = 'vimeo';
                $video_url_params = parse_url($request->lecture_video_link);
                $video_id = str_replace('/', '', $video_url_params['path']);
                $video_duration = VideoHandler::vimeoVideoDuration($video_id);
                $duration = $video_duration;
            } else {
                $provider = 'youtube';
                $video_url_params = parse_url($request->lecture_video_link);
                parse_str($video_url_params['query'], $params);
                $video_id = $params['v'];
                $duration = VideoHandler::getYoutubeDuration($video_id);
                $video_duration = VideoHandler::covtime($duration);
                $duration = $video_duration;
            }
        } else {
            if(empty($request->lecture_video_name)){
                $video_uploaded = $this->upload_lecture_video($request->lecture_video);
                $duration = $request->lecture_video_duration;
            }
            $video_link = $request->lecture_video_link;
        }

        if(!empty($request->lecture_video_name)){
            $video_uploaded = $request->lecture_video_name;
            $duration = $request->lecture_video_name_duration;
        }

        $addLecture = Lecture::create([
            'section_id' => $request->section_id,
            'lecture_title' => $request->lecture_title,
            'lecture_video' => $video_uploaded,
            'duration' => $duration,
            'lecture_video_link' => $video_link,
            'slug' => $slug
        ]);

        if ($addLecture) {
            $sections = Section::with('getLectures')->withCount('getLectures')->where('course_id', $request->course_id)->get();
            $updateLectureCount = Course_tracking::where('course_id', $request->course_id)->update([
                'no_of_lectures' => $sections->sum('get_lectures_count'),
            ]);
            $html = view('admin.includes.section-boxes-view', compact('sections'))->render();
            DB::commit();
            return json_encode([
                'Success' => true,
                'Msg' => __('translation.Lecture has been Added successfully'),
                'html' => $html
            ]);
        } else {
            DB::rollback();
            return json_encode([
                'Success' => false,
                'Msg' => __('translation.Something went wrong Please try again')
            ]);
        }
        } catch (\Throwable $th) {
            DB::rollback();
            return json_encode([
                'Success' => false,
                'Msg' => __('translation.Something went wrong Please try again')
            ]);
        }
    }

    public function del_single_lecture(Request $request)
    {
        // $getLecture = Lecture::where('id', $request->lecture_id)->first();
        // if(!empty($getLecture->lecture_video)){
        //     $this->delete_file('lectures',$getLecture->lecture_video);
        // }
        $lectureDelete = Lecture::where('id', $request->lecture_id)->delete();
        if ($lectureDelete) {
            $sections = Section::with('getLectures')->withCount('getLectures')->where('course_id', $request->course_id)->get();
            $updateLectureCount = Course_tracking::where('course_id', $request->course_id)->update([
                'no_of_lectures' => $sections->sum('get_lectures_count'),
            ]);
            $html = view('admin.includes.section-boxes-view', compact('sections'))->render();
            return json_encode([
                'success' => true,
                'message' => __('translation.Lecture has been deleted successfully'),
                'html' => $html
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => __('translation.Something went wrong Please try again')
            ]);
        }
    }

    public function edit_single_lecture(Request $request)
    {
        $validate = \Validator::make($request->all(), [
            'lecture_title' => 'required',
        ]);
        if ($validate->fails()) {
            return json_encode([
                "success" => false,
                'message' => $validate->errors()->first()
            ]);
        }
        $data = [];
        $data['lecture_title'] = $request->lecture_title;
        if(!empty($request->lecture_video_name)){
            $data['lecture_video'] = $request->lecture_video_name;
        }
        if(!empty($request->lecture_video_name_duration)){
            $data['duration'] = $request->lecture_video_name_duration;
        }
        $updateLecture = Lecture::where('id', $request->lecture_id)->update($data);
        if ($updateLecture) {
            $sections = Section::with('getLectures')->where('course_id', $request->course_id)->get();
            $html = view('admin.includes.section-boxes-view', compact('sections'))->render();
            return json_encode([
                'success' => true,
                'message' => __('translation.Lecture has been edited successfully'),
                'html' => $html
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => __('translation.Something went wrong Please try again')
            ]);
        }
    }

    public function deleteCourseSchedule(Request $request)
    {
        $data = Course::where('id', $request->course_id)->first();
        $courseSchedule = json_decode($data->course_schedule);

        $key = array_search($request['course_schedule'], $courseSchedule);
        unset($courseSchedule[$key]);
        $newArray = array_values($courseSchedule);

        $updateCourse = Course::where('id', $request->course_id)->update([
            'course_schedule' => json_encode($newArray)
        ]);

        if ($updateCourse) {
            return json_encode([
                'success' => true,
                'message' => __('translation.Course has been updated successfully')
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' =>  __('translation.Something went wrong Please try again')
            ]);
        }

    }
}
