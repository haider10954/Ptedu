<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Offline_course;
use App\Models\Reservation;
use App\Models\Tutor;
use Illuminate\Http\Request;

class OfflineCourseController extends Controller
{
    public function offline_course_listing()
    {
        $offline_course = Offline_course::withCount(['getReservationWaiting', 'getReservationReserved'])->paginate(10);
        return view('admin.offline_lectures.offline_courses', compact('offline_course'));
    }

    public function add_offline_course_view()
    {
        $tutor = Tutor::get();
        $category = Category::get();
        return view('admin.offline_lectures.add_offline_course', compact('tutor', 'category'));
    }

    function upload_files($file)
    {
        if (!file_exists(storage_path('app/public/offline_course/thumbnail'))) {
            mkdir(storage_path('app/public/offline_course/thumbnail'), 0755);
        }
        $fileName =  time() . mt_rand(300, 9000) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/offline_course/thumbnail', $fileName);
        $loadPath = storage_path('app/public/') . '/' . $fileName;
        return $fileName;
    }

    function upload_files_banner($file)
    {
        if (!file_exists(storage_path('app/public/offline_course/banner'))) {
            mkdir(storage_path('app/public/offline_course/banner'), 0755);
        }
        $fileName = time() . mt_rand(300, 9000) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/offline_course/banner', $fileName);
        $loadPath = storage_path('app/public/') . '/' . $fileName;
        return $fileName;
    }


    public function add_offline_course(Request $request)
    {
        $request->validate([
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
            'course_img' => 'required|mimes:jpeg,png,jpg',
            'banner_img' => 'required|mimes:jpeg,png,jpg',
            'no_of_enrollments' => 'required',
        ]);
        $course_thumbnail = $this->upload_files($request['course_img']);
        $course_banner = $this->upload_files_banner($request['banner_img']);
        $offline_course = Offline_course::create([
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
            'no_of_enrollments' => $request['no_of_enrollments']

        ]);

        if ($offline_course) {
            return json_encode([
                'success' => true,
                'message' => 'Offline Course has been added successfully.'
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => 'Something went wrong Please try again.'
            ]);
        }
    }

    public function delete_offline_course(Request $request)
    {
        $offline_course = Offline_course::where('id', $request->id)->first();
        $filePath = storage_path('app/public/offline_course/thumbnail/' . $offline_course->course_thumbnail);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $filePath2 = storage_path('app/public/offline_course/banner/' . $offline_course->course_banner);
        if (file_exists($filePath2)) {
            unlink($filePath2);
        }
        $offline_course = Offline_course::where('id', $request['id'])->delete();
        if ($offline_course) {
            return redirect()->back()->with('msg', 'Offline Course has been deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong Please try again.');
        }
    }

    public function edit_offline_course_view($id)
    {
        $offline_course = Offline_course::where('id', $id)->first();
        $tutor = Tutor::get();
        $category = Category::get();
        return view('admin.offline_lectures.edit_offline_course', compact('offline_course', 'tutor', 'category'));
    }

    public function edit_offline_course(Request $request)
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
            'course_img' => 'mimes:jpeg,png,jpg',
            'banner_img' => 'mimes:jpeg,png,jpg',
            'no_of_enrollments' => 'required',
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
        $data['no_of_enrollments'] = $request['no_of_enrollments'];
        $offline_course = Offline_course::where('id', $request->id)->update($data);

        if ($offline_course) {
            return json_encode([
                'success' => true,
                'message' => 'Offline course has been updated successfully.'
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => 'Something went wrong Please try again.'
            ]);
        }
    }
}
